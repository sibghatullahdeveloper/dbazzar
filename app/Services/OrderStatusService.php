<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\OrderStatus;
use Illuminate\Support\Str;


class OrderStatusService
{

    public static function OrderStatusList(){

        return OrderStatus::get();
    }

    public static function SaveOrderStatus($request){

        $orderstatus = new OrderStatus();


        if(isset($request['id'])){

        $orderstatus->where('id',$request['id'])
                ->update([
                            'name' => $request['name'],
                            'status' => $request['status'],
                            'updated_at' =>Carbon::now()
                          ]);
        }else{
                $orderstatus->name=$request['name'];
                $orderstatus->status=$request['status'];
                $orderstatus->uuid=Str::uuid();
                $orderstatus->save();
        }

        return true;
    }

    public function EditOrderStatus($uuid){
        
        $orderstatus = OrderStatus::where('uuid',$uuid)->first();
        
        return  $orderstatus;
    }

    public function DeleteOrderStatus($id){

        $orderstatus = OrderStatus::find($id);
        $orderstatus->delete();
        
        return  true;
    }

}