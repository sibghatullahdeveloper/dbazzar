<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EntitiesService;
use App\Services\FoodItemsService;
use App\Services\CheckoutService;
use App\Services\EntitiesSettingService;
use App\Services\OrdersService;
use App\Model\AddOnsCategory;
use App\Model\Tags;
use App\Model\AddOns;
use App\Model\SavedVoucher;
use App\Model\FoodItems;
use App\Events\OrderPlaced as OrderNotify;

class CheckoutController extends Controller
{
    //
	protected $EntitiesService;
    protected $FoodItemsService;
    protected $CheckoutService;
    protected $EntitiesSettingService;
    protected $OrdersService;

	  public function __construct(EntitiesService $EntitiesService,FoodItemsService $FoodItemsService, CheckoutService $CheckoutService, EntitiesSettingService $EntitiesSettingService, OrdersService $OrdersService) {
        $this->EntitiesService = $EntitiesService;
        $this->FoodItemsService = $FoodItemsService;
        $this->CheckoutService = $CheckoutService;
        $this->EntitiesSettingService = $EntitiesSettingService;
        $this->OrdersService = $OrdersService;
    }

  
  public function addItemTocart(Request $request){

    

    $inputData= $request->all();
   // dd($inputData);
    
     $user = \Auth::guard('customer')->user();
        if($user != Null){
                    $token = Null;
            $result = $this->CheckoutService->addItemToCartByUser($inputData, $user->id);  
            // $cart = $this->CheckoutService->getCartByUser($result->user_id);      
        }
        else
        {
            if(isset($_COOKIE["cookie_token"])){
                    $token=$_COOKIE['cookie_token'];

              }
            else
              {   
                $cookie_token = $this->CheckoutService->generateRandomString();
                setcookie("cookie_token", $cookie_token, time()+86400, "/","", 0);
                $token=$cookie_token;

            }
            $result = $this->CheckoutService->addItemToCartByToken($inputData, $token);
           //  $cart = $this->CheckoutService->getCartByToken($result->cookie_token);
        }

  

    //dd($result);
    echo $result;
  }

  public function increaseQuantity(Request $request){

    $inputData = $request->all();

    $result = $this->CheckoutService->increaseItemQuantity($inputData);

    echo $result;
  }

   public function dcreaseQuantity(Request $request){

    $inputData = $request->all();

    $result = $this->CheckoutService->dcreaseItemQuantity($inputData);

    echo $result;
  }

  public function showcheckoutform(){

       if(isset($_COOKIE["cookie_token"])){
   
                    $token=$_COOKIE['cookie_token'];

              }

    $cart = $this->CheckoutService->getCartByToken($token);
   
    $branch_id = '';
    foreach ($cart as $value) {
        
       $branch_id = $value->entity_id;
       
    }
    $entity = $this->EntitiesService->getEntityBranchById($branch_id);
    $settings = $this->EntitiesSettingService->getEntityBranchSettings($branch_id);
    return view('checkout' ,compact('cart' , 'entity','settings'));
  }

  public function showcheckoutuser(){

     $user = \Auth::guard('customer')->user();
     
     $address = $this->CheckoutService->GetConsumerAddressess($user->id);
     $cart = $this->CheckoutService->getCartByUser($user->id);
    //dd($cart);
    $branch_id = '';
    foreach ($cart as $value) {
        
       $branch_id = $value->entity_id;
       
    }
    $entity = $this->EntitiesService->getEntityBranchById($branch_id);
   
    $voucher = [];
   //dd($entity->entity_id,$branch_id ,\Auth::guard('customer')->user()->id);
    if($entity){
      $voucher = SavedVoucher::where('user_id',\Auth::guard('customer')->user()->id)->where('entity_id', $entity->entity_id)->where('status', 1)->with('evoucher')->get();
    }
    $settings = $this->EntitiesSettingService->getEntityBranchSettings($branch_id);
    // dd(\Auth::guard('customer')->user()->id);
    return view('usercheckout' ,compact('cart', 'address', 'entity' ,'user', 'voucher','settings'));

  }
  public function showcheckoutOptions(){

    if(\Auth::guard('customer')->user())
    {
      return redirect()->route('Checkout');
    }
    else
    {
      return view('chekoutOptions');
    }
    
  }
  public function applyvoucher(Request $request){
      
     // dd($request->all());
    $voucher_id = $request['id'];

    $res = SavedVoucher::where('id',$voucher_id)->update(['status' => 0]);

    return $res;

  }
  public function placeyourOrder(Request $request){

      $order_id = $this->CheckoutService->placeyourOrder($request->all());
    
   

   if($order_id)
   {
    
     $order = $this->OrdersService->GetOrder($order_id);
     $branch_id = $order->branch_id;
     $settings = $this->EntitiesSettingService->getEntityBranchSettings($branch_id);

     foreach ($order->orderdetails as $item) {
            
            $product = FoodItems::where('id',$item->product_id)->first();

            $addons_array =[];
            $item->product = $product->name;

                $addon_names = [];
             $addons_array =json_decode($item->addons,true);
                 foreach ($addons_array as $value) {
                     $name = AddOns::select( 'name')
                    ->where('id', $value)
                    ->first();
                    array_push($addon_names,$name->name);
                 }
               
               $item->addon_names = $addon_names;


        }
      $this->sendNotification($order->id);
        
     return view('userinvoice',compact('order','settings'));
    //$msg = "Thank You Your Order Has Been Placed Successfully !";
    //return redirect()->back()->with('success', $msg);
   }

  }

  public function sendNotification($orderId){
    $message = 'New Order Received';

    event(new OrderNotify($message, $orderId));
  }

  public function placeUserOrder(Request $request){

    //dd($request);

    //dd($request->all());
     if($request->voucher_id){
      $order_id = $this->CheckoutService->placeyourOrderWithVoucher($request->all());
    }
    else
    {
      $order_id = $this->CheckoutService->placeUserOrder($request->all());
    }
    

   if($order_id)
   {
     $order = $this->OrdersService->GetOrder($order_id);
     $branch_id = $order->branch_id;
     $settings = $this->EntitiesSettingService->getEntityBranchSettings($branch_id);

     foreach ($order->orderdetails as $item) {
            
            $product = FoodItems::where('id',$item->product_id)->first();

            $addons_array =[];
            $item->product = $product->name;

                $addon_names = [];
             $addons_array =json_decode($item->addons,true);
                 foreach ($addons_array as $value) {
                     $name = AddOns::select( 'name')
                    ->where('id', $value)
                    ->first();
                    array_push($addon_names,$name->name);
                 }
               
               $item->addon_names = $addon_names;


        }
        $this->sendNotification($order->id);

     //dd($order,$settings);
     return view('userinvoice',compact('order','settings'));
   }

  }

  public function removeItem(Request $request)
  {
    $result = $this->CheckoutService->removeItem($request->id);

    return $result;
  }

  public function emptyTheCart(){

       $user = \Auth::guard('customer')->user();
        if($user != Null){
                    
                $result = $this->CheckoutService->EmptyUserCart($user->id);
        }
        else
        {
          $token = Null;
            if(isset($_COOKIE["cookie_token"])){
                    $token=$_COOKIE['cookie_token'];

              }
           $result = $this->CheckoutService->EmptytokenCart($token);
        }

   

    return $result;
  }

  public function MyOrders(){
    
    $user = \Auth::guard('customer')->user();
    $orders = $this->OrdersService->GetMyOrders($user->id);
    foreach ($orders as $order) {

    
    if($order->orderdetails !=null)
    {

     foreach ($order->orderdetails as $item) {
            
            $product = FoodItems::where('id',$item->product_id)->first();

            $addons_array =[];
            $item->product = $product->name;

                $addon_names = [];
             $addons_array =json_decode($item->addons,true);
                 foreach ($addons_array as $value) {
                     $name = AddOns::select( 'name')
                    ->where('id', $value)
                    ->first();
                    array_push($addon_names,$name->name);
                 }
               
               $item->addon_names = $addon_names;


        }
    }
    }
   // dd($orders);
    return view('myorders', compact('orders'));
  }

}
