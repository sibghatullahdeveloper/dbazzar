<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\FoodItems;
use Illuminate\Support\Str;


class FoodItemsService
{

    public static function FoodItemsList($entity_id){

        return FoodItems::where('entity_id',$entity_id)->orderBy('order_by','ASC')->get();
    }

    public static function SaveFoodItems($request){
       // dd($request->all());
        $fooditems = new FoodItems();
        $entity_id = \Auth::guard('entity')->user()->entity_id;
        //dd($entity_id);
        $addons_ids = json_encode($request->addons_ids);
        //$p_cat_ids = json_encode($request->p_cat_ids);

        if ($request->file('image')) {

             $image = $request->file('image');
             $fooditems->image=$image->getClientOriginalName();
             $destinationPath = public_path('images/foodItems_images');
             $image->move($destinationPath, $fooditems->image);

           // $fooditems->image = $request->file('image');
           // $imageName = time().'.'.$fooditems->image->extension();
            //$fooditems->image = $request->image->store('/foodItems_images', 'public');

            if(isset($request['id'])){

                $fooditems->where('id',$request['id'])
                        ->update([
                                    'name' => $request['name'],
                                    'status' => $request['status'],
                                    'description' => $request['description'],
                                    'price' => $request['price'],
                                    'display_price' => $request['display_price'],
                                    'discount' => $request['discount'],
                                    'image' => $fooditems->image,
                                    'order_by' => $request['order_by'],
                                    'addons_id' => $addons_ids,
                                    'p_cat_id' => $request['p_cat_ids'],
                                    'entity_id' => $entity_id,
                                    'updated_at' =>Carbon::now()
                                  ]);
            }else{
                $fooditems->name=$request['name'];
                $fooditems->status=$request['status'];
                $fooditems->description=$request['description'];
                $fooditems->price=$request['price'];
                $fooditems->display_price = $request['display_price'];
                $fooditems->order_by =  $request['order_by'];
                $fooditems->addons_id=$addons_ids;
                $fooditems->discount=$request['discount'];
                $fooditems->p_cat_id=$request['p_cat_ids'];
                $fooditems->entity_id =$entity_id;
                $fooditems->uuid=Str::uuid();
                $fooditems->save();
            }
        }
        else{

            if(isset($request['id'])){

                $fooditems->where('id',$request['id'])
->update([                                     'name' => $request['name'],
'status' => $request['status'],
'description' => $request['description'],
'price' => $request['price'],
'display_price' => $request['display_price'],
'addons_id' => $addons_ids,                                     'order_by' =>
$request['order_by'],                                     'discount' =>
$request['discount'],                                     'p_cat_id' =>
$request['p_cat_ids'],                                     'entity_id' =>
$entity_id,                                     'updated_at' =>Carbon::now()
]);             }else{                 $fooditems->name=$request['name'];
$fooditems->status=$request['status'];
$fooditems->description=$request['description'];
$fooditems->price=$request['price'];                 $fooditems->display_price
= $request['display_price'];
$fooditems->addons_id=$addons_ids;                 $fooditems->order_by
=$request['order_by'];
$fooditems->discount=$request['discount'];
$fooditems->p_cat_id=$request['p_cat_ids'];
$fooditems->entity_id =$entity_id;
$fooditems->uuid=Str::uuid();                 $fooditems->save();
}         }


        return true;
    }

    public function EditFoodItems($uuid){

        $fooditems = FoodItems::where('uuid',$uuid)->first();

        return  $fooditems;
    }

    public function DeleteFoodItems($id){

        $fooditems = FoodItems::find($id);
        $fooditems->delete();

        return  true;
    }


}
