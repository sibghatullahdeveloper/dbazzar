<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\AddOnsCategory;
use Illuminate\Support\Str;


class AddOnsCategoryService
{

    public static function AddOnsCategoryList($entity_id = null){

        return AddOnsCategory::where('entity_id',$entity_id)->orderBy('order_by','ASC')->get();
    }

    public static function SaveAddOnsCategory($request, $entity_id){

        $addons_cat = new AddOnsCategory();

        $addons_id = json_encode($request->addons_id);

        if(isset($request['id'])){

        $addons_cat->where('id',$request['id'])
                ->update([
                            'name' => $request['name'],
                            'status' => $request['status'],
                            'description' => $request['description'],
                            'entity_id' =>$entity_id,
                            'selection_type' =>$request['selection_type'],
                            'max_selection' => $request['max_selection'],
                            'min_selection' => $request['min_selection'],
                            'required' => $request['required'],
                            'order_by' => $request['order_by'],
                            'addons_id' => $addons_id,
                            'updated_at' =>Carbon::now()
                          ]);
        }else{
                $addons_cat->name=$request['name'];
                $addons_cat->status=$request['status'];
                $addons_cat->description=$request['description'];
                $addons_cat->addons_id=$addons_id;
                $addons_cat->entity_id = $entity_id;
                $addons_cat->selection_type = $request['selection_type'];
                $addons_cat->max_selection= $request['max_selection'];
                $addons_cat->min_selection = $request['min_selection'];
                $addons_cat->required = $request['required'];
                $addons_cat->order_by = $request['order_by'];
                $addons_cat->uuid=Str::uuid();
                $addons_cat->save();
        }

        return true;
    }

    public function EditAddOnsCategory($uuid){
        
        $addons_cat = AddOnsCategory::where('uuid',$uuid)->first();
        
        return  $addons_cat;
    }

    public function DeleteAddOnsCategory($id){

        $addons_cat = AddOnsCategory::find($id);
        $addons_cat->delete();
        
        return  true;
    }

}