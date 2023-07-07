<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use App\Services\EvoucherService;
use App\Services\EntitiesService;
use App\Services\EmailService;
use App\Model\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use View;
use App\Model\ConsumerUser;

class EvoucherController extends Controller
{
    protected $EvoucherService;
    protected $EntitiesService;
    protected $email_service;
    public function __construct(EvoucherService $EvoucherService, EntitiesService $EntitiesService, EmailService $email_service){
        
        $this->EvoucherService = $EvoucherService;
        $this->EntitiesService = $EntitiesService;
         $this->email_service = $email_service;
    }

    public function index(){

        $entity_id = \Auth::guard('entity')->user()->entity_id;

        $evouchers= $this->EvoucherService->EvoucherList($entity_id);
        return view('Entity::evouchers.index')->with('lists', $evouchers);
    }

    public function create(){

        return view('Entity::evouchers.create_form');
    }

    public function store(Request $request){

        $entity = Entities::where('id',\Auth::guard('entity')->user()->entity_id)->first();
        $evoucher = $this->EvoucherService->SaveEvoucher($request, $entity->id);
            

        
          $users = ConsumerUser::where('email_verified',1)->get();
         // dd($users);
          foreach ($users as $value) {
             $url = url('/saveVoucher').'/'.$evoucher->id.'/'.$value->id;
             $msg = $this->email_service->sendVoucherEmail($value->first_name,$value->last_name,$value->email,$evoucher->name,$evoucher->description,$url);
          }

        return redirect()->route('entity.evouchers');
    }

    public function edit($uuid){

        $evouchers=$this->EvoucherService->EditEvoucher($uuid);

        return view('Entity::evouchers.edit_form')->with('data', $evouchers);
    }

    public function update(Request $request, $id){

        $entity = Entities::where('id',\Auth::guard('entity')->user()->entity_id)->first();
        $this->EvoucherService->SaveEvoucher($request, $entity->id);
        
        return redirect()->route('entity.evouchers');
    }

    public function delete($id){

        $result=  $this->EvoucherService->DeleteEvoucher($id);
        if($result){
            $msg="Add Ons remove successfully";
        }elseif($result)
        {
            $msg="Add Ons Not remove";
        }
        return redirect()->back()->with('success', $msg);
    }

}