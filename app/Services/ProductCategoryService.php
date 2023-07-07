<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\ProductCategories;
use Illuminate\Support\Str;


class ProductCategoryService
{

    public static function ProductCategoryList($entity_id = null){

        return ProductCategories::where('entity_id',$entity_id)->get();
    }

    public static function SaveProductCategory($request, $entity_id){

        $p_cat = new ProductCategories();

        if(isset($request['id'])){

        $p_cat->where('id',$request['id'])
                ->update([
                            'name' => $request['name'],
                            'status' => $request['status'],
                            'start_date_time' => Carbon::parse($request['start_time'])->format('H:i'),
                            'end_date_time' => Carbon::parse($request['end_time'])->format('H:i'),
                            'order_by' => $request['order_by'],
                            'entity_id' => $entity_id,
                            'updated_at' =>Carbon::now()
                          ]);
        }else{
                $p_cat->name = $request['name'];
                $p_cat->start_date_time = Carbon::parse($request['start_time'])->format('H:i');
                $p_cat->end_date_time = Carbon::parse($request['end_time'])->format('H:i');
                $p_cat->order_by = $request['order_by'];
                $p_cat->status = $request['status'];
                $p_cat->entity_id = $entity_id;
                $p_cat->uuid = Str::uuid();
                $p_cat->save();
        }

        return true;
    }

    public function EditProductCategory($uuid){
        
        $p_cat = ProductCategories::where('uuid',$uuid)->first();
        
        return  $p_cat;
    }

    public function DeleteProductCategory($id){

        $p_cat = ProductCategories::find($id);
        $p_cat->delete();
        
        return  true;
    }

    public function FindCategoriesById($ids){
        //dd($ids);
        if($ids != null){
        $lists = json_decode($ids);

        $i = 0;
        foreach($lists as $list){

            $output[$i] = ProductCategories::where('id',$list)->where('entity_id',\Auth::guard('entity')->user()->entity_id)->first();
            $output[$i++];

        }
        
        return  $output;
    }
    return true;
    }

}