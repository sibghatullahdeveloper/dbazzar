<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use App\Model\Affiliate;
use Illuminate\Support\Str;


class AffiliateService
{

    public static function AffiliateList(){

        return Affiliate::get();
    }

    public static function SaveAffiliate($request){

        $affiliate = new Affiliate();

        if($request['affiliate_post_type']=='AM'){
            $area_manager=  Affiliate::where('area_id',$request['area_id'])->exists();
            
            if($area_manager){
                return 'Area Manager already exist';
            }
            else{
                $parent_id =0;
            }

        }
        else if($request['affiliate_post_type']=='SAM'){

            $sub_area_manager=  Affiliate::where('sub_area_id',$request['sub_area_id'])->exists();

            if($sub_area_manager){
                return 'Sub Area Manager Already Exists';
            }
            
            $area_manager=  Affiliate::where('area_id',$request['area_id'])->first();

            if($area_manager){

                $parent_id =$area_manager->id;
                
            }
            else{
                
                return 'Area Manager not exist';
            }
        }
        else{
            
            if($request['sub_area_id'] !=null){

                $sub_area_manager=Affiliate::where('sub_area_id',$request['sub_area_id'] )->first();
                
                if($sub_area_manager){
                    $parent_id =$sub_area_manager->id;
                
                }
                else{
                    
                    return 'Sub Area Manager not exist';
                }
            }
        }

        if(isset($request['uuid'])){

            if($request['password'] != ''){
                    
                $userdata['password'] = md5($request['password']);
            }
            $userdata['email'] = $request['email'];

            if($request['status'] == 1){
                
                $userdata['email_verified'] = 1;
            
            }
            else{
                    $userdata['email_verified'] =0;
            }
            
            $user =User::where('id',$request['user_id'])->first();
            $user->update($userdata);

            $affiliate->where('uuid',$request['uuid'])
                ->update([
                    'name' => $request['name'],
                    'status' => $request['status'],
                    'contact' => $request['contact'],
                    'address' => $request['address'],
                    'email' => $request['email'],
                    'affiliate_post_type' => $request['affiliate_post_type'],
                    'area_id' => $request['area_id'],
                    'sub_area_id' => $request['sub_area_id'],
                    'parent_id' => $parent_id,
                    'updated_at' =>Carbon::now()
                ]);
        }
        else{
            $affiliate->name = $request['name'];
            $affiliate->status = $request['status'];
            $affiliate->contact = $request['contact'];
            $affiliate->address = $request['address'];
            $affiliate->email = $request['email'];
            $affiliate->affiliate_post_type = $request['affiliate_post_type'];
            $affiliate->area_id = $request['area_id'];
            $affiliate->sub_area_id = $request['sub_area_id'];
            $affiliate->parent_id = $parent_id;
            $affiliate->uuid=Str::uuid();
            $affiliate->save();
            $affiliate_id = $affiliate->id;
            
            $userdata['uuid'] = Str::uuid(40)->toString();
            $userdata['password'] = md5($request['password']);
            $userdata['user_type'] = 'AFFILIATE';
            $username = explode('@',$request['email']);
            $userdata['username'] = $username[0];
            $userdata['email'] = $request['email'];
            $userdata['affiliate_id'] = $affiliate_id;

            if($request['status'] == 1){
                
                $userdata['email_verified'] = 1;
            }
            else{
                
                $userdata['email_verified'] =0;
            }
            $userdata['first_name'] = $request['name'];
            $user = new User();

            $user_id= $user->create($userdata)->id;
        }

        return 'successfully';
    }

    public function EditAffiliate($uuid){
        
        $affiliate = Affiliate::where('uuid',$uuid)->with('user')->first();

        return  $affiliate;
    }

    public function DeleteAffiliate($id){

        $affiliate = Affiliate::find($id);
        $affiliate->delete();
        
        return  true;
    }

}