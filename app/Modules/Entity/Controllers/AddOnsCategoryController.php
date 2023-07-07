<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AddOnsCategoryService;
use App\Services\AddOnsService;
use App\Model\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use View;



class AddOnsCategoryController extends Controller
{
    protected $AddOnsCategoryService;
    protected $AddOnsService;

    public function __construct(AddOnsCategoryService $AddOnsCategoryService, AddOnsService $AddOnsService){
        
        $this->AddOnsCategoryService = $AddOnsCategoryService;
        $this->AddOnsService = $AddOnsService;
    }

    public function index(){
        
        $entity_id = \Auth::guard('entity')->user()->entity_id;
        $addons_cat= $this->AddOnsCategoryService->AddOnsCategoryList($entity_id);
            
        return view('Entity::addonscategory.index')->with('lists', $addons_cat);
    }

    public function create(){
        
        $addons = $this->AddOnsService->AddOnsList();
        return view('Entity::addonscategory.create_form')->with('addons', $addons);
    }

    public function store(Request $request){
        $this->AddOnsCategoryService->SaveAddOnsCategory($request, \Auth::guard('entity')->user()->entity_id);
        return redirect()->route('entity.addonscategory');
    }

    public function edit($uuid){
        
        $addons_cat=$this->AddOnsCategoryService->EditAddOnsCategory($uuid);
        $addons = $this->AddOnsService->AddOnsList();
        $selectedAddon =[];

         if($addons_cat->addons_id != null){
          $selectedAddon =json_decode($addons_cat->addons_id,true);
         }
        return view('Entity::addonscategory.edit_form')->with('data', $addons_cat)->with('addons', $addons)->with('selectedAddon', $selectedAddon);
    }

    public function update(Request $request, $id){

        $this->AddOnsCategoryService->SaveAddOnsCategory($request,\Auth::guard('entity')->user()->entity_id);
        return redirect()->route('entity.addonscategory');
    }

    public function delete($id){

        $result=  $this->AddOnsCategoryService->DeleteAddOnsCategory($id);
        if($result){
            $msg="Add Ons Category remove successfully";
        }elseif($result)
        {
            $msg="Add Ons Category Not remove";
        }
        return redirect()->back()->with('success', $msg);
    }

}



