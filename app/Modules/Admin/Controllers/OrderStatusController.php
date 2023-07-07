<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SponsoredRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\OrderStatusService;
use App\Services\EntitiesService;



class OrderStatusController extends Controller
{
    protected $OrderStatusService;
    protected $EntitiesService;

    public function __construct(OrderStatusService $OrderStatusService ,EntitiesService  $EntitiesService)
    {
        $this->OrderStatusService = $OrderStatusService;
        $this->EntitiesService = $EntitiesService;
    }

        public function index()
        {

            $OrderStatus_list= $this->OrderStatusService->OrderStatusList();

            return view('Admin::OrderStatus.index')->with('lists', $OrderStatus_list);
        }

        public function create()
        {
            return view('Admin::OrderStatus.create_form');
        }

        public function store(Request $request)
        {
            $result=$this->OrderStatusService->SaveOrderStatus($request);
            
            // if($result && isset($request->cat_id)){
            //    $msg="Sponsored updated successfully";
            // }elseif($result)
            // {
            //    $msg="Sponsored Created successfully";
            // }

            // return redirect()->back()->with('success', $msg);
            return redirect()->route('admin.orderstatus');
        }
        public function edit($uuid)
        {
            $OrderStatus=$this->OrderStatusService->EditOrderStatus($uuid);

            return view('Admin::OrderStatus.edit_form')->with('items',$OrderStatus);

        }
        public function delete($id)
        {

            $result=  $this->OrderStatusService->DeleteOrderStatus($id);

            return redirect()->back()->with('success', $result);
        }

}