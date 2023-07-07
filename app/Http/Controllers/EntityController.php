<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EntitiesService;
use App\Services\FoodItemsService;
use App\Services\CheckoutService;
use App\Services\EntitiesSettingService;
use App\Model\AddOnsCategory;
use App\Model\Tags;
use App\Model\AddOns;
class EntityController extends Controller
{
    //
	protected $EntitiesService;
    protected $FoodItemsService;
    protected $CheckoutService;
    protected $EntitiesSettingService;
	  public function __construct(EntitiesService $EntitiesService,FoodItemsService $FoodItemsService, CheckoutService $CheckoutService,EntitiesSettingService $EntitiesSettingService) {
        $this->EntitiesService = $EntitiesService;
        $this->FoodItemsService = $FoodItemsService;
        $this->CheckoutService = $CheckoutService;
        $this->EntitiesSettingService = $EntitiesSettingService;
    }

    public function index($slug){


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
           //delete_cookie($token);
        }


    	$entity = $this->EntitiesService->getEntityBranchBySlug($slug);
    	$entity_id = $entity->entity_id;
        $branch_id = $entity->id;
    	$productCat = $this->EntitiesService->getAllProductsCat($entity_id);
        //dd($productCat);
        $products = $this->FoodItemsService->FoodItemsList($entity_id);
        $settings = $this->EntitiesSettingService->getEntityBranchSettings($branch_id);
       // dd($settings);
        $header ='';
         $Gallery = [];
         foreach ($entity->Pictures as $Picture) {

            if($Picture->type == 'Header')
            {
              $header = $Picture->picture;
            }
            else if($Picture->type == 'Gallery')
            {
              array_push($Gallery, $Picture->picture);
            }
         }
         if($entity->tags != null)
            {
                $tags_array =json_decode($entity->tags,true);
                $tag_name = Tags::select( 'name')
                    ->whereIn('id', $tags_array)
                    ->get();
                $entity->tags_name=$tag_name;
            }else
            {
                $entity->tags_name='';
            }
            $pcatids = [];
            foreach ($productCat as $p_id) {

                array_push($pcatids,$p_id->id);
                # code...
            }
            $categories = AddOnsCategory::where('entity_id',$entity_id)->orderBy('order_by','ASC')->get();
           // dd($categories);
            $aCatsids =[];
            foreach ($categories as $cat){
                array_push($aCatsids,$cat->id);
            }
         //   dd($aCatsids);
        $addonids =[];
            $Entityaddons = AddOns::where('entity_id',$entity_id)->orderBy('order_by','ASC')->get();
            foreach ($Entityaddons as $addons){
                array_push($addonids,$addons->id);
            }
        $addoncatArray =[];
        foreach ($products as $prod) {
           // dd($prod->addons_id);
            if($prod->addons_id != "null" && $prod->addons_id != null){
            $addon_cat[]=json_decode($prod->addons_id, true);
            $count = count($addon_cat[0]);
            if($count > 0){
            for ($i=0; $i<$count; $i++)
            {

                if(in_array($addon_cat[0][$i],$aCatsids)){

                    $adds = AddOnsCategory::where('id',$addon_cat[0][$i])->orderBy('order_by','ASC')->first();
                   // dd($adds);

                    if($adds->addons_id != null){
                        $addOnArray =[];
                        $addonitems []=json_decode($adds->addons_id, true);
                        $count1 = count($addonitems[0]);
                        //dd($addonitems,$addonids);
                        $a = 0;
                        for($j =0; $j<$count1;$j++){
                            $a++;
                            if(in_array($addonitems[0][$j],$addonids)){
                                $addons =AddOns::where('id',$addonitems[0][$j])->orderBy('order_by','ASC')->first();

                                array_push($addOnArray,$addons);
                            }

                        }
                     //   dd($addOnArray);
                    }
                    $addonitems =[];
                    $adds->addons = $addOnArray;
                    $addOnArray =[];
                    array_push($addoncatArray, $adds);
                }
            }
            }
                $addon_cat =[];
            $prod->addonCatogories = $addoncatArray;
            $addoncatArray =[];
            }
        }

        $token = "";
        if(isset($_COOKIE["cookie_token"])){
   
                    $token=$_COOKIE['cookie_token'];

              }

        $cart = $this->CheckoutService->getCartByToken($token);
    	//dd($products);
    	return view('entity', compact('entity','products','productCat', 'header','Gallery' ,'pcatids','cart','settings'));
    }
}
