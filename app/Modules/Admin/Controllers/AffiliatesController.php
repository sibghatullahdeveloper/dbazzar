<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AffiliateService;
use App\Services\AreaManagementService;
use App\Services\SubAreaManagementService;
use App\Model\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use View;



class AffiliatesController extends Controller
{
    protected $AffiliateService;
    protected $AreaManagementService;

    public function __construct(AffiliateService $AffiliateService, AreaManagementService $AreaManagementService, SubAreaManagementService $SubAreaManagementService){
        
        $this->AffiliateService = $AffiliateService;
        $this->AreaManagementService = $AreaManagementService;
        $this->SubAreaManagementService = $SubAreaManagementService;
    }

    public function index(){
        
        $affiliate_list= $this->AffiliateService->AffiliateList();
        return view('Admin::affiliates.index')->with('lists', $affiliate_list);
    }

    public function create(){
        
        $areas =  $this->AreaManagementService->getAllAreas();

        return view('Admin::affiliates.create_form')->with('areas',$areas);
    }

    public function store(Request $request){
        
        $result= $this->AffiliateService->SaveAffiliate($request);
        return redirect()->back()->with('success', $result);
        // return redirect()->route('admin.affiliates');
    }

    public function edit($uuid){
        
        $affiliate=$this->AffiliateService->EditAffiliate($uuid);
        $areas =  $this->AreaManagementService->getAllAreas();
        
        return view('Admin::affiliates.edit_form')->with('data', $affiliate)->with('areas', $areas);
    }

    public function update(Request $request){

        $this->AffiliateService->SaveAffiliate($request);
        
        return redirect()->route('admin.affiliates');
    }

    public function delete($id){

        $result=  $this->AffiliateService->DeleteAffiliate($id);
        
        if($result){
            
            $msg="Affiliate remove successfully";
        
        }elseif($result){
            
            $msg="Affiliate Not remove";
        }
        
        return redirect()->back()->with('success', $msg);
    }

    public function getAreas(){

        $areas =  $this->AreaManagementService->getAllAreas();
        
        return $areas;
    }

    public function getSubAreas(Request $request){

        $sub_areas =  $this->SubAreaManagementService->getSubAreaById($request->id);
        
        echo json_encode($sub_areas);
    }

}



