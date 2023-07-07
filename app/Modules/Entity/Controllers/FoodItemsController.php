<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FoodItemsService;
use App\Services\AddOnsService;
use App\Services\ProductCategoryService;
use App\Services\AddOnsCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use View;



class FoodItemsController extends Controller
{
    protected $FoodItemsService;
    protected $AddOnsService;
    protected $ProductCategoryService;
    protected $AddOnsCategoryService;

    public function __construct(FoodItemsService $FoodItemsService, AddOnsService $AddOnsService, ProductCategoryService $ProductCategoryService,AddOnsCategoryService $AddOnsCategoryService){
        
        $this->FoodItemsService = $FoodItemsService;
        $this->AddOnsService = $AddOnsService;
        $this->ProductCategoryService = $ProductCategoryService;
        $this->AddOnsCategoryService = $AddOnsCategoryService;
    }

    public function index(){

        $fooditems= $this->FoodItemsService->FoodItemsList(\Auth::guard('entity')->user()->entity_id);
        return view('Entity::fooditems.index')->with('lists', $fooditems);
    }

    public function create(){
        $entity_id = \Auth::guard('entity')->user()->entity_id;
        $addons = $this->AddOnsService->AddOnsList();
        $addons_cat = $this->AddOnsCategoryService->AddOnsCategoryList($entity_id);
        $p_cat = $this->ProductCategoryService->ProductCategoryList($entity_id);

        return view('Entity::fooditems.create_form')->with('addons', $addons_cat)->with('p_cat', $p_cat);
    }

  
    public function store(Request $request){
        
        $this->FoodItemsService->SaveFoodItems($request);
        return redirect()->route('entity.fooditems');
    }
    
    public function edit($uuid){
         $entity_id = \Auth::guard('entity')->user()->entity_id;
         $addons_cat = $this->AddOnsCategoryService->AddOnsCategoryList($entity_id);
         //dd($addons_cat->id);
        $fooditems=$this->FoodItemsService->EditFoodItems($uuid);

        $FindAddOns = [];

         if($fooditems->addons_id != null){
          $FindAddOns =json_decode($fooditems->addons_id,true);
         }
         else {
             $FindAddOns = [];
         }

         // $FindCategories= [];
         //  if($fooditems->p_cat_id != null){
         //  $FindCategories =json_decode($fooditems->p_cat_id,true);
         // }
        // dd($FindCategories);
        $addons = $this->AddOnsService->AddOnsList();
        $p_cat = $this->ProductCategoryService->ProductCategoryList($entity_id);
        //dd($p_cat);
        return view('Entity::fooditems.edit_form')->with('data', $fooditems)->with('addons', $addons_cat)->with('p_cat', $p_cat)->with('FindAddOns', $FindAddOns);
    }

    public function update(Request $request, $id){

        $this->FoodItemsService->SaveFoodItems($request);
        return redirect()->route('entity.fooditems');
    }

    public function delete($id){

        $result=  $this->FoodItemsService->DeleteFoodItems($id);
        if($result){
            $msg="Food Item remove successfully";
        }elseif($result)
        {
            $msg="Food Item Not remove";
        }
        return redirect()->back()->with('success', $msg);
    }

   

}



