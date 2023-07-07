<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductCategoryService;
use App\Services\EntitiesService;
use App\Model\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use View;



class ProductCategoryController extends Controller
{
    protected $ProductCategoryService;
    protected $EntitiesService;

    public function __construct(ProductCategoryService $ProductCategoryService, EntitiesService $EntitiesService){

        $this->ProductCategoryService = $ProductCategoryService;
        $this->EntitiesService = $EntitiesService;
    }

    public function index(){

        $entity_id = \Auth::guard('entity')->user()->entity_id;
        //dd($entity_id);
        $p_cat= $this->ProductCategoryService->ProductCategoryList($entity_id);


        foreach ($p_cat as $data) {

            $data->start_date_time = date("g:i a", strtotime($data->start_date_time));
            $data->end_date_time = date("g:i a", strtotime($data->end_date_time));
        }

        return view('Entity::productcategory.index')->with('lists', $p_cat);
    }

    public function create(){

        return view('Entity::productcategory.create_form');
    }

    public function store(Request $request){
       
        $entity = Entities::where('id',\Auth::guard('entity')->user()->entity_id)->first();
        $this->ProductCategoryService->SaveProductCategory($request, $entity->id);

        return redirect()->route('entity.productcategory');
    }

    public function edit($uuid){

        $p_cat=$this->ProductCategoryService->EditProductCategory($uuid);

        $p_cat->start_date_time = date("g:i a", strtotime($p_cat->start_date_time));
        $p_cat->end_date_time = date("g:i a", strtotime($p_cat->end_date_time));

        return view('Entity::productcategory.edit_form')->with('data', $p_cat);
    }

    public function update(Request $request, $id){
        // dd($request);
        $entity = Entities::where('id',\Auth::guard('entity')->user()->entity_id)->first();
        $this->ProductCategoryService->SaveProductCategory($request, $entity->id);
        return redirect()->route('entity.productcategory');
    }

    public function delete($id){

        $result=  $this->ProductCategoryService->DeleteProductCategory($id);
        if($result){
            $msg="Product Category remove successfully";
        }elseif($result)
        {
            $msg="Product Category Not remove";
        }
        return redirect()->back()->with('success', $msg);
    }

}



