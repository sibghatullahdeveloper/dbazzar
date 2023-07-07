<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\AddOns;
use Illuminate\Support\Str;


class AddOnsService
{

    public static function AddOnsList(){

        return AddOns::orderBy('order_by','ASC')->get();
    }

    public static function SaveAddOns($request){

        $addons = new AddOns();

        if ($request->file('image')) {

            $addons->image = $request->file('image');
            $imageName = time().'.'.$addons->image->extension();
            $addons->image = $request->image->store('/AddOns_images', 'public');
            
            if(isset($request['id'])){

            $addons->where('id',$request['id'])
                    ->update([
                                'name' => $request['name'],
                                'status' => $request['status'],
                                'image' => $addons->image,
                                'order_by' => $request['order_by'],
                                'price' => $request['price'],
                                'updated_at' =>Carbon::now()
                              ]);
            }else{
                    $addons->name=$request['name'];
                    $addons->status=$request['status'];
                    $addons->price=$request['price'];
                    $addons->order_by=$request['order_by'];
                    $addons->uuid=Str::uuid();
                    $addons->save();
            }
        }
        else{
            if(isset($request['id'])){

            $addons->where('id',$request['id'])
                    ->update([
                                'name' => $request['name'],
                                'status' => $request['status'],
                                'price' => $request['price'],
                                'order_by' =>$request['order_by'],
                                'updated_at' =>Carbon::now()
                              ]);
            }else{
                $addons->name=$request['name'];
                $addons->status=$request['status'];
                $addons->price=$request['price'];
                $addons->order_by=$request['order_by'];
                $addons->uuid=Str::uuid();
                $addons->save();
            }
        }

        return true;
    }

    public function EditAddOns($uuid){
        
        $addons = AddOns::where('uuid',$uuid)->first();
        
        return  $addons;
    }

    public function DeleteAddOns($id){

        $addons = AddOns::find($id);
        $addons->delete();
        
        return  true;
    }

    public function FindAddOnsById($ids){

        $lists = json_decode($ids);

        $i = 0;
        foreach($lists as $list){

            $output[$i] = AddOns::where('id',$list)->first();
            $output[$i++];

        }
        
        return  $output;
    }

}