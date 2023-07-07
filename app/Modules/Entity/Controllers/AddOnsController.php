<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AddOnsService;
use App\Services\AddOnsCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use View;


class AddOnsController extends Controller
{
    protected $AddOnsService;
    protected $AddOnsCategoryService;

    public function __construct(AddOnsService $AddOnsService, AddOnsCategoryService $AddOnsCategoryService){
        
        $this->AddOnsService = $AddOnsService;
        $this->AddOnsCategoryService = $AddOnsCategoryService;
    }

    public function index(){

        $addons= $this->AddOnsService->AddOnsList();
        return view('Entity::addons.index')->with('lists', $addons);
    }

    public function create(){

        return view('Entity::addons.create_form');
    }

    public function store(Request $request){
        
        $this->AddOnsService->SaveAddOns($request);
        return redirect()->route('entity.addons');
    }

    public function edit($uuid){

        $addons=$this->AddOnsService->EditAddOns($uuid);

        return view('Entity::addons.edit_form')->with('data', $addons);
    }

    public function update(Request $request, $id){

        $this->AddOnsService->SaveAddOns($request);
        return redirect()->route('entity.addons');
    }

    public function delete($id){

        $result=  $this->AddOnsService->DeleteAddOns($id);
        if($result){
            $msg="Add Ons remove successfully";
        }elseif($result)
        {
            $msg="Add Ons Not remove";
        }
        return redirect()->back()->with('success', $msg);
    }

}



