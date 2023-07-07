<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\OrderDetail;
use App\Model\Order;
use Illuminate\Support\Str;


class OrdersService
{

    public static function OrdersList(){

        return Order::with('orderdetails', 'orderstatus', 'entitybranch','consumer')->orderBy('id', 'desc')->get();
    }

    public static function OrdersListForDashboard(){

        return Order::with('orderdetails', 'orderstatus', 'entitybranch','consumer')->orderBy('id', 'desc')->limit(10)->get();
    }

    public static function OrdersById($query){
        
        return Order::where('id',$query)->with('orderdetails', 'orderstatus', 'entitybranch','consumer')->get();
    }

    public static function OrdersByCustomerId($query){
        
        return Order::where('consumer_id',$query)->with('orderdetails', 'orderstatus', 'entitybranch','consumer')->get();
    }


    function GetOrder($id){

     return Order::where('id',$id)->with('orderdetails','ConsumerAddress','entitybranch')->first();   
    }

    function GetMyOrders($user_id)
    {

    	return Order::where('consumer_id',$user_id)->with('orderdetails','ConsumerAddress','entitybranch')->get();
    }
}