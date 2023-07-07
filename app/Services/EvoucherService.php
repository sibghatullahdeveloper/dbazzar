<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\Evoucher;
use Illuminate\Support\Str;
use App\Model\ConsumerUser;
use App\Services\EmailService;
class EvoucherService
{

    protected $email_service;

    public function __construct(EmailService $email_service){
         $this->email_service = $email_service;
    }
    public static function EvoucherList($entity_id = null){

        return Evoucher::where('entity_id',$entity_id)->get();
    }

    public static function SaveEvoucher($request, $entity_id){

        $evoucher = new Evoucher();

        if ($request->discount_type == 'FIXED') {
            $evoucher->discount_amount = $request->discount_amount;
            $evoucher->discount_percentage = null;
        }else{
            $evoucher->discount_percentage = $request->discount_percentage;
            $evoucher->discount_amount = null;
        }

        if ($request->file('image')) {

            $evoucher->image = $request->file('image');
            $imageName = time().'.'.$evoucher->image->extension();
            $evoucher->image = $request->image->store('/Evouchers_images', 'public');
            
            if(isset($request['id'])){

            $evoucher->where('id',$request['id'])
                    ->update([
                                'name' => $request['name'],
                                'status' => $request['status'],
                                'image' => $evoucher->image,
                                'description' => $request['description'],
                                'discount_type' => $request['discount_type'],
                                'discount_percentage' => $evoucher->discount_percentage,
                                'discount_amount' => $evoucher->discount_amount,
                                'updated_at' =>Carbon::now()
                              ]);
            }else{
                    $evoucher->name=$request['name'];
                    $evoucher->status=$request['status'];
                    $evoucher->description=$request['description'];
                    $evoucher->discount_type=$request['discount_type'];
                    $evoucher->entity_id = $entity_id;
                    $evoucher->uuid=Str::uuid();
                    $evoucher->save();
            }
        }
        else{
            if(isset($request['id'])){

            $evoucher->where('id',$request['id'])
                    ->update([
                                'name' => $request['name'],
                                'status' => $request['status'],
                                'description' => $request['description'],
                                'discount_type' => $request['discount_type'],
                                'discount_percentage' => $evoucher->discount_percentage,
                                'discount_amount' => $evoucher->discount_amount,
                                'updated_at' =>Carbon::now()
                              ]);
            }else{
                $evoucher->name=$request['name'];
                $evoucher->status=$request['status'];
                $evoucher->description=$request['description'];
                $evoucher->discount_type=$request['discount_type'];
                $evoucher->entity_id = $entity_id;
                $evoucher->uuid=Str::uuid();
                $evoucher->save();
            }
        }



        return $evoucher;
    }

    public function EditEvoucher($uuid){
        
        $evoucher = Evoucher::where('uuid',$uuid)->first();
        
        return  $evoucher;
    }

    public function DeleteEvoucher($id){

        $evoucher = Evoucher::find($id);
        $evoucher->delete();
        
        return  true;
    }

}