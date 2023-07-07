<?php

namespace App\Services;

use App\User;
use App\Model\AddOns;
use App\Model\FoodItems;
use App\Model\EntityBranch;
use App\Model\Affiliate;
use App\Model\AffiliateLedger;
use App\Model\SavedVoucher;
use App\Model\ConsumerUser;
use App\Model\ConsumerAddressess;
use Carbon\Carbon;
use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\EntitiesSettings;
use Illuminate\Support\Str;
use DB;

class CheckoutService
{

  
    public function addItemToCartByToken($inputData , $token){
//dd($inputData);
    $prod_id = $inputData['prod_id'];
    $branch_id = $inputData['branch_id'];
    $total_price = $inputData[$prod_id.'_total_price'];
    $comment = $inputData[$prod_id.'_comment'];
    $quantity = $inputData[$prod_id.'_quantity'];

    $inputData2 =[];
     foreach ($inputData as $key => $value) {
         # code...
         $string = explode("_",$key);
         //dd(count($string));
         $string= $string[count($string) - 1];
        if($key != 'prod_id' && $key != $prod_id.'_total_price' &&  $key != $prod_id.'_comment'  && $key != $prod_id.'_quantity' 
                && $key != '_token' && $value != null && $value != "on" && $value != "off" && $key != 'branch_id' && $string != 'price')
        {
           array_push($inputData2,$value);
        }
     }
    //   dd($inputData2);
    $addons = json_encode($inputData2);
   
    $data['cookie_token'] = $token;
    $data['product_id'] = $prod_id;
    $data['total_price'] = $total_price;
    $data['comments'] = $comment;
    $data['quantity'] = $quantity;
    $data['addons'] = $addons;
    $data['entity_id'] =$branch_id;
    $cart = new Cart();
    $res = $cart->create($data);
    //dd($addons);
$product = FoodItems::where('id',$res->product_id)->first();

            
    $res->product = $product->name;
    $addons_array =[];
    $addon_names = [];
             $addons_array =json_decode($res->addons,true);
           //  dd($addons_array);
                 foreach ($addons_array as $value) {
                     $name = AddOns::select( 'name')
                    ->where('id', $value)
                    ->first();
                   // print($name);
                    array_push($addon_names,$name->name);
                 }
               
               $res->addon_names = $addon_names;

    return $res;
    }

     public function addItemToCartByUser($inputData , $user_id){
      //  dd($inputData);
    $prod_id = $inputData['prod_id'];
    $branch_id = $inputData['branch_id'];
    $total_price = $inputData[$prod_id.'_total_price'];
    $comment = $inputData[$prod_id.'_comment'];
    $quantity = $inputData[$prod_id.'_quantity'];
    $inputData2 =[];

     foreach ($inputData as $key => $value) {
         # code...
         $string = explode("_",$key);
         //dd(count($string));
         $string= $string[count($string) - 1];
        if($key != 'prod_id' && $key != $prod_id.'_total_price' &&  $key != $prod_id.'_comment'  && $key != $prod_id.'_quantity' 
                && $key != '_token' && $value != null && $value != "on" && $value != "off" && $key != 'branch_id' && $string != 'price')
        {
           array_push($inputData2,$value);
        }
     }
  //   dd($inputData2);
     $addons = json_encode($inputData2);
   
     $data['cookie_token'] = "";
     $data['user_id'] =$user_id;
     $data['product_id'] = $prod_id;
     $data['total_price'] = $total_price;
     $data['comments'] = $comment;
     $data['quantity'] = $quantity;
     $data['addons'] = $addons;
     $data['entity_id'] =$branch_id;
     $cart = new Cart();
     $res = $cart->create($data);
    // dd($res);
     $product = FoodItems::where('id',$res->product_id)->first();

            
    $res->product = $product->name;
    $addons_array =[];
    $addon_names = [];
             $addons_array =json_decode($res->addons,true);
           //  dd($addons_array);
                 foreach ($addons_array as $value) {
                     $name = AddOns::select( 'name')
                    ->where('id', $value)
                    ->first();
                    array_push($addon_names,$name->name);
                 }
               
               $res->addon_names = $addon_names;


     return $res;
    }


    public function getCartByToken($token){

        $cart = Cart::where('cookie_token',$token)->get();

        foreach ($cart as $item) {
            
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
        return $cart;

    }
     public function getCartByUser($user_id){

        $cart = Cart::where('user_id',$user_id)->get();

        foreach ($cart as $item) {
            
            $product = FoodItems::where('id',$item->product_id)->first();

            $addons_array =[];
            $item->product = $product->name;

                $addon_names = [];
             $addons_array =json_decode($item->addons,true);
            // dd($addons_array);
                 foreach ($addons_array as $value) {
                     $name = AddOns::select( 'name')
                    ->where('id', $value)
                    ->first();
                    array_push($addon_names,$name->name);
                 }
               
               $item->addon_names = $addon_names;


        }
        return $cart;

    }

    public function increaseItemQuantity($inputData)
    {
       // dd($inputData);
        $cart = Cart::where('id',$inputData['id'])->first();
       // dd($cart);
        $cart->update([
                 'quantity' => $inputData['qty'] , 'total_price' => $inputData['price']
            ]);

        return $cart;
    }

     public function dcreaseItemQuantity($inputData)
    {
        $cart = Cart::where('id',$inputData['id'])->first();

        $cart->update([
                 'quantity' => $inputData['qty'] , 'total_price' => $inputData['price']
            ]);

        return $cart;
    }

    public function generateRandomString($length = 10) {
            
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
  }

  public function placeyourOrder($inputData){
  //  dd($inputData);

    if(isset($_COOKIE["cookie_token"])){
   
                    $token=$_COOKIE['cookie_token'];

              }

    $cart = $this->getCartByToken($token);

    $userdata['first_name'] = $inputData['first_name'];
    $userdata['last_name'] = $inputData['last_name'];
    $userdata['email'] =$inputData['email'];
    $userdata['username'] = $inputData['first_name'].'_'.$inputData['last_name'];
    $userdata['contact_number'] = $inputData['contact_number'];
    $userdata['password'] =  md5($this->generateRandomString(5));
    $userdata['uuid'] = Str::uuid(40)->toString();
    $userdata['user_type'] = 'CUSTOMER';
    $userdata['email_verified'] = 0;
    $userdata['email_verified_token'] = Str::random(40);
    $userdata['password_changed'] = 0;

    $user = new ConsumerUser();
    $user_id =$user->create($userdata)->id;

    $addressData['address'] = $inputData['address'];
    $addressData['latitude'] =$inputData['user_lat'];
    $addressData['longitude'] =$inputData['user_long'];
    $addressData['consumer_id'] = $user_id;

    $userAddress = new ConsumerAddressess();
    $consumer_address_id = $userAddress->create($addressData)->id;
   // dd($userAddress);
    $orderdata['payment_id'] = $this->generateRandomString(8);
    $orderdata['name'] = $inputData['first_name'].' '.$inputData['last_name'];
    $orderdata['number'] = $inputData['contact_number'];
    $orderdata['payment_mode'] =$inputData['payment_mode'];
    $orderdata['delivery_instruction'] =$inputData['delivery_instruction'];
    $orderdata['consumer_id'] = $user_id;
    $orderdata['consumer_address_id'] = $consumer_address_id;
    $order = new Order();
    $order_id = $order->create($orderdata)->id;
    $total_amount = 0;
    $branch_id='';
    foreach ($cart as $item) {
        $detail['product_id'] =$item->product_id;
        $detail['order_id'] = $order_id;
        $detail['quantity'] = $item->quantity;
        $detail['addons'] = $item->addons;
        $detail['amount'] = $item->total_price;
        $detail['description'] =$item->comments;
        $order_detail = new OrderDetail();

        $order_detail->create($detail);
        $total_amount = $total_amount + $item->total_price;

        $branch_id = $item->entity_id;
    }
    
    $branch = EntityBranch::where('id',$branch_id)->first();
    //tax information
     $orderdata['branch_id'] = $branch->id;
      $charges = $branch->delivery_charge;
    $settings = EntitiesSettings::where('branch_id',$branch_id)->first();
    if(!empty($settings) && $settings->tax != null)
    {
        $tax = $settings->tax;
    $tax_value =($total_amount * ($tax/100));
      $orderdata['tax'] = $tax_value;
   
    $total_amount = $total_amount + $charges + $tax_value;
    }
    else
    {
        $total_amount = $total_amount + $charges;
    }
    
   
  
    $orderdata['total_amount'] = $total_amount;

    $order = Order::find($order_id)->update($orderdata);
    
    if($order){
       DB::table('usercart')->where('cookie_token', $token)->delete();

        $branch = EntityBranch::where('id',$branch_id)->first();
        //dd($branch);
       $affiliate_id =$branch->affiliate_id;
       $affiliate = Affiliate::where('id',$affiliate_id)->first();

       if($affiliate->affiliate_post_type == 'AM'){
            $commision = (float)$total_amount * (float)(0.015);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

       }
       else if($affiliate->affiliate_post_type == 'SAM')
       {

            $commision = (float)$total_amount * (float)(0.01);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

            $parent_id = $affiliate->parent_id;
             $commision1 = (float)$total_amount * (float)(0.015);    
             $ledger1 = new  AffiliateLedger();
             $ledgerdata1['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata1['type'] ='CREDIT';
            $ledgerdata1['affiliate_id'] = $parent_id;
            $ledgerdata1['amount'] = $commision1;
            $ledger1->create($ledgerdata1);
       

       }
       else
       {
            $commision = (float)$total_amount * (float)(0.005);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

            $parent_id = $affiliate->parent_id;
             $commision1 = (float)$total_amount * (float)(0.01);    
             $ledger1 = new  AffiliateLedger();
             $ledgerdata1['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata1['type'] ='CREDIT';
            $ledgerdata1['affiliate_id'] = $parent_id;
            $ledgerdata1['amount'] = $commision1;
            $ledger1->create($ledgerdata1);

            $aff = Affiliate::where('id',$parent_id)->first();

            $affiliate_idd = $aff->parent_id;
             $commision2 = (float)$total_amount * (float)(0.015);    
             $ledger2 = new  AffiliateLedger();
             $ledgerdata2['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata2['type'] ='CREDIT';
            $ledgerdata2['affiliate_id'] = $affiliate_idd;
            $ledgerdata2['amount'] = $commision2;
            $ledger2->create($ledgerdata2);

       } 
        return $order_id;
    }
    
  }


public function placeUserOrder($inputData){
   // dd($inputData);
    $user_id = $inputData['user_id'];
    $user = ConsumerUser::where('id',$user_id)->first();
    $user->update(['contact_number' => $inputData['contact_number']]);

    $consumer_address_id = '';
    if($inputData['address'] != null)
    {
         $userAddress = new ConsumerAddressess();
    $addressData['address'] = $inputData['address'];
    $addressData['latitude'] =$inputData['user_lat'];
    $addressData['longitude'] =$inputData['user_long'];
    $addressData['consumer_id'] =$user_id;

   
   $address_id = $userAddress->create($addressData)->id;
    //dd($address_id);
    $consumer_address_id = $address_id;
    }
    else

       {
        $consumer_address_id = $inputData['select_address'];
       } 
  // dd($consumer_address_id);

    $cart = $this->getCartByUser($user_id);

    $orderdata['payment_id'] = $this->generateRandomString(8);
    $orderdata['name'] = $inputData['first_name'].' '.$inputData['last_name'];
    $orderdata['number'] = $inputData['contact_number'];
    $orderdata['payment_mode'] =$inputData['payment_mode'];
    $orderdata['consumer_id'] =$inputData['user_id'];
    $orderdata['consumer_address_id'] = $consumer_address_id;
     $orderdata['delivery_instruction'] =$inputData['delivery_instruction'];
    $order = new Order();
    $order_id = $order->create($orderdata)->id;
    $total_amount = 0;
    $branch_id='';
    foreach ($cart as $item) {
        $detail['product_id'] =$item->product_id;
        $detail['order_id'] = $order_id;
        $detail['quantity'] = $item->quantity;
        $detail['addons'] = $item->addons;
        $detail['amount'] = $item->total_price;
        $detail['description'] =$item->comments;
        $order_detail = new OrderDetail();

        $order_detail->create($detail);
        $total_amount = $total_amount + $item->total_price;

        $branch_id = $item->entity_id;
    }
    
    $branch = EntityBranch::where('id',$branch_id)->first();



    $orderdata['branch_id'] = $branch->id;
    $charges = $branch->delivery_charge;
     $settings = EntitiesSettings::where('branch_id',$branch_id)->first();
    if(!empty($settings) && $settings->tax != null)
    {
        $tax = $settings->tax;
    $tax_value =($total_amount * ($tax/100));
      $orderdata['tax'] = $tax_value;
   
    $total_amount = $total_amount + $charges + $tax_value;
    }
    else
    {
        $total_amount = $total_amount + $charges;
    }

    $orderdata['total_amount'] = $total_amount;
    $orderdata['discount_amount'] = 0;
    $order = Order::find($order_id)->update($orderdata);
    
    if($order){
       DB::table('usercart')->where('user_id', $user_id)->delete();

       $branch = EntityBranch::where('id',$branch_id)->first();

       $affiliate_id =$branch->affiliate_id;
       $affiliate = Affiliate::where('id',$affiliate_id)->first();
       // dd($affiliate);
       if($affiliate->affiliate_post_type == 'AM'){
            $commision = (float)$total_amount * (float)(0.015);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

       }
       else if($affiliate->affiliate_post_type == 'SAM')
       {

            $commision = (float)$total_amount * (float)(0.01);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

            $parent_id = $affiliate->parent_id;
             $commision1 = (float)$total_amount * (float)(0.015);    
             $ledger1 = new  AffiliateLedger();
             $ledgerdata1['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata1['type'] ='CREDIT';
            $ledgerdata1['affiliate_id'] = $parent_id;
            $ledgerdata1['amount'] = $commision1;
            $ledger1->create($ledgerdata1);
       

       }
       else
       {
            $commision = (float)$total_amount * (float)(0.005);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

            $parent_id = $affiliate->parent_id;
             $commision1 = (float)$total_amount * (float)(0.01);    
             $ledger1 = new  AffiliateLedger();
             $ledgerdata1['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata1['type'] ='CREDIT';
            $ledgerdata1['affiliate_id'] = $parent_id;
            $ledgerdata1['amount'] = $commision1;
            $ledger1->create($ledgerdata1);

            $aff = Affiliate::where('id',$parent_id)->first();

            $affiliate_idd = $aff->parent_id;
             $commision2 = (float)$total_amount * (float)(0.015);    
             $ledger2 = new  AffiliateLedger();
             $ledgerdata2['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata2['type'] ='CREDIT';
            $ledgerdata2['affiliate_id'] = $affiliate_idd;
            $ledgerdata2['amount'] = $commision2;
            $ledger2->create($ledgerdata2);

       } 

        return $order_id;
    }
    
  }

     public function placeyourOrderWithVoucher($inputData){

        $voucher_id = $inputData['voucher_id'];

        $voucher = SavedVoucher::where('id' , $voucher_id)->with('evoucher')->first();
       // dd($voucher);
       
        $user_id = $inputData['user_id'];
    $cart = $this->getCartByUser($user_id);

     $consumer_address_id = '';
    if($inputData['address'] != null)
    {
         $addressData['address'] = $inputData['address'];
    $addressData['latitude'] =$inputData['user_lat'];
    $addressData['longitude'] =$inputData['user_long'];
    $addressData['consumer_id'] =$user_id;

    $userAddress = new ConsumerAddressess();
    $userAddress->create($addressData);

    $consumer_address_id = $userAddress->id;
    }
    else

       {
        $consumer_address_id = $inputData['select_address'];
       } 

    $orderdata['payment_id'] = $this->generateRandomString(8);
    $orderdata['name'] = $inputData['first_name'].' '.$inputData['last_name'];
    $orderdata['number'] = $inputData['contact_number'];
    $orderdata['payment_mode'] =$inputData['payment_mode'];
    $orderdata['consumer_id'] =$inputData['user_id'];
    $orderdata['consumer_address_id'] = $consumer_address_id;
     $orderdata['delivery_instruction'] =$inputData['delivery_instruction'];
    $order = new Order();
    $order_id = $order->create($orderdata)->id;
    $total_amount = 0;
    $branch_id='';
    foreach ($cart as $item) {
        $detail['product_id'] =$item->product_id;
        $detail['order_id'] = $order_id;
        $detail['quantity'] = $item->quantity;
        $detail['addons'] = $item->addons;
        $detail['amount'] = $item->total_price;
        $detail['comments'] =$item->comments;
        $order_detail = new OrderDetail();

        $order_detail->create($detail);
        $total_amount = $total_amount + $item->total_price;

        $branch_id = $item->entity_id;
    }
    
    $branch = EntityBranch::where('id',$branch_id)->first();

    $orderdata['branch_id'] = $branch->id;
    $charges = $branch->delivery_charge;
     $settings = EntitiesSettings::where('branch_id',$branch_id)->first();
    if(!empty($settings) && $settings->tax != null)
    {
        $tax = $settings->tax;
    $tax_value =($total_amount * ($tax/100));
      $orderdata['tax'] = $tax_value;
   
    $total_amount = $total_amount + $charges + $tax_value;
    }
    else
    {
        $total_amount = $total_amount + $charges;
    }

     $discount_amount = 0;
        if($voucher->evoucher->discount_type == 'FIXED'){
            $discount_amount = $voucher->evoucher->discount_amount;
        }
        else {
            $dicount_percent = $voucher->evoucher->discount_amount;
            $dicount_percent = $dicount_percent / 100;
            $discount_amount = $total_amount * $dicount_percent;
        }

        $total_amount = $total_amount - $discount_amount;

    
    $orderdata['total_amount'] = $total_amount;
    $orderdata['discount_amount'] = $discount_amount;
    SavedVoucher::where('id',$voucher_id)->update(['status' => 0]);

    $order = Order::find($order_id)->update($orderdata);
    
    if($order){
       DB::table('usercart')->where('user_id', $user_id)->delete();

       $branch = EntityBranch::where('id',$branch_id)->first();

       $affiliate_id =$branch->affiliate_id;
       $affiliate = Affiliate::where('id',$affiliate_id)->first();
       // dd($affiliate);
       if($affiliate->affiliate_post_type == 'AM'){
            $commision = (float)$total_amount * (float)(0.015);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

       }
       else if($affiliate->affiliate_post_type == 'SAM')
       {

            $commision = (float)$total_amount * (float)(0.01);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

            $parent_id = $affiliate->parent_id;
             $commision1 = (float)$total_amount * (float)(0.015);    
             $ledger1 = new  AffiliateLedger();
             $ledgerdata1['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata1['type'] ='CREDIT';
            $ledgerdata1['affiliate_id'] = $parent_id;
            $ledgerdata1['amount'] = $commision1;
            $ledger1->create($ledgerdata1);
       

       }
       else
       {
            $commision = (float)$total_amount * (float)(0.005);
            $ledger = new AffiliateLedger();
            $ledgerdata['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata['type'] ='CREDIT';
            $ledgerdata['affiliate_id'] = $affiliate_id;
            $ledgerdata['amount'] = $commision;
            $ledger->create($ledgerdata);

            $parent_id = $affiliate->parent_id;
             $commision1 = (float)$total_amount * (float)(0.01);    
             $ledger1 = new  AffiliateLedger();
             $ledgerdata1['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata1['type'] ='CREDIT';
            $ledgerdata1['affiliate_id'] = $parent_id;
            $ledgerdata1['amount'] = $commision1;
            $ledger1->create($ledgerdata1);

            $aff = Affiliate::where('id',$parent_id)->first();

            $affiliate_idd = $aff->parent_id;
             $commision2 = (float)$total_amount * (float)(0.015);    
             $ledger2 = new  AffiliateLedger();
             $ledgerdata2['transaction_no'] = $orderdata['payment_id'];
            $ledgerdata2['type'] ='CREDIT';
            $ledgerdata2['affiliate_id'] = $affiliate_idd;
            $ledgerdata2['amount'] = $commision2;
            $ledger2->create($ledgerdata2);

       } 

        return $order_id;
    }


     }


  public function removeItem($id){

    DB::table('usercart')->where('id',$id)->delete();
    return 1;
  }

   public function MakeUserCartFromCookies($token,$user_id){
    
    $cart = Cart::where('cookie_token', $token)
            ->update(['user_id' => $user_id, 'cookie_token' => '']);
     return $cart;       
  }

  public function GetConsumerAddressess($id){

    return ConsumerAddressess::where('consumer_id' ,$id)->get();

  }

  public function EmptyUserCart($user_id)
  {
    DB::table('usercart')->where('user_id',$user_id)->delete();
    return 1;
  } 

  public function EmptytokenCart($token)
  {
    DB::table('usercart')->where('cookie_token',$token)->delete();
    return 1;
  } 

}