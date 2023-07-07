<?php

namespace App\Services;
use App\Model\City;
use App\Model\Entities;
use App\Model\EntityBranch;
use App\Model\ProductCategories;
use App\Model\Services;
use App\Model\Affiliate;
use App\Model\BranchPictures;
use App\Model\BranchTimmings;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Object_;
use App\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ForgotPasswordToken;
use DB;
class EntitiesService {

    public function SaveEntity($inputData){

        try {


            $data['name'] = $inputData['entity_name'];
            $data['entity_cat'] = $inputData['entity_cat'];
            $data['status'] = $inputData['status'];

            if($inputData['uuid'] != ''){
               // dd("here");
                if($inputData['password'] != ''){
                    $userdata['password'] = md5($inputData['password']);
                }
                $userdata['email'] = $inputData['entity_email'];

                if($inputData['status'] == 1){
                    $userdata['email_verified'] = 1;
                }
                else
                {
                    $userdata['email_verified'] =0;
                }

                $user =User::where('id',$inputData['user_id'])->first();
             //   dd($user);

                $entity = Entities::where('uuid', $inputData['uuid'])->first();

                 if($user != null)
                {
                    $user->update($userdata);
                }
                else
                {
                    $user = new User();
                   // dd("here");
                    $userdata['uuid'] = Str::uuid(40)->toString();
                $userdata['user_type'] = 'ENTITYADMIN';
                $username = explode('@',$inputData['entity_email']);
                $userdata['username'] = $username[0];

                $userdata['first_name'] = $inputData['entity_name'];
                 $userdata['entity_id'] = $entity->id;
                    $user->create($userdata);
                }

                $result = $entity->update($data);

                if($result)
                {
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{
                $userdata['uuid'] = Str::uuid(40)->toString();
                $userdata['email'] = $inputData['entity_email'];
                $userdata['password'] = md5($inputData['password']);
                $userdata['user_type'] = 'ENTITYADMIN';
                $username = explode('@',$inputData['entity_email']);
                $userdata['username'] = $username[0];
                if($inputData['status'] == 1){
                    $userdata['email_verified'] = 1;
                }
                else
                {
                    $userdata['email_verified'] =0;
                }
                $userdata['first_name'] = $inputData['entity_name'];


                $entity = new Entities();
                $data['uuid'] = Str::uuid(40)->toString();


                $result = $entity->create($data);
                $userdata['entity_id'] = $result->id;
                $user = new User();

                $user_id= $user->create($userdata)->id;
                if($result)
                {
                    return 1;
                }
                else{
                    return 0;
                }

            }

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getAllEntities(){


        try{
            $entities = Entities::with('Category')->get();

            return $entities;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getAllEntitiesIndex($uuid){
        try{

//                $items = Entities::select('id','name')->where('uuid','=',$uuid);
            $items = Entities::select('id', 'name')
                ->where('uuid','=',$uuid)
                ->first();
            return $items;
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }


    public function getAllEntitiesIndexing(){
        try{
            $items = Entities::select('id', 'name')->get();
          return $items;
        }  catch (\Exception $e) {

        return $e->getMessage();
        }
    }
    public function getEntity($uuid){

        try{

            $entity = Entities::where('uuid', $uuid)->with('user')->first();

            return $entity;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getEntityById($id){
        try{

            $entity = Entities::where('id', $id)->first();
            return $entity;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function DeleteEntity($uuid){

        try{
            Entities::where('uuid',$uuid)->delete();
            return 1;
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function DeleteEntityBranch($uuid){

        try{
            $EntityBranch = EntityBranch::where('uuid',$uuid)->first();
            $branch_id = $EntityBranch->id;
               DB::table('entitybranch_pictures')->where('branch_id', $branch_id)->delete();
            EntityBranch::where('uuid',$uuid)->delete();
            return 1;
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function getAllEntityBranches($uuid){
        try{

            $entity = Entities::where('uuid',$uuid)->first();

            $entity_id = $entity->id;

            $branches = EntityBranch::where('entity_id',$entity_id)->with('Service')->get();
            $data['entity'] = $entity;
            $data['branches'] = $branches;
            return $data;
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function getAllBranches(){

        try{

            $branches = EntityBranch::select()->with('Entity')->get();
            //dd($branches);

            return $branches;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function SaveEntityBranch($inputData){
       //dd($inputData);
        try{
            $entity = Entities::where('uuid',$inputData['uuid'])->first();
            $entity_id = $entity->id;
            $data['title'] = $inputData['title'];
            $data['slug'] = $inputData['slug'];
            $data['phone'] = $inputData['phone'];
            $contactArray = [];
            array_push($contactArray, [
                'name' => $inputData['contact_name'],
               'phone' => $inputData['contact_phone'],
                'email' => $inputData['contact_email'],
            ]);
            $contact = json_encode($contactArray);
            //dd($contact);


            $addressArray =[];
            array_push($addressArray, [
                'street_no' => $inputData['street_no'] ,
                'country' => $inputData['country'],
                'city' => $inputData['city'],
                'zip_code' => $inputData['zip_code'],
                'state' => $inputData['state'],
            ]);
            $address = json_encode($addressArray);
           // dd($address);
            $data['affiliate_id'] = $inputData['affiliate'];

            $selectedCuisines = json_encode($inputData['cuisines']);
            $selectedTags = '';
            if(isset($inputData['tags']))
            $selectedTags = json_encode($inputData['tags']);

            $data['contact'] = $contact;
            $data['address']= $address;

            $data['service_id'] = $inputData['service_id'];
            $data['cuisines'] = $selectedCuisines;
            $data['tags']=$selectedTags;
            $data['entity_id'] =$entity_id;
            $data['about']=$inputData['about'];
            $timmings =[];

            //dd($timmings);
            $data['entity_lat'] = $inputData['entity_lat'];
            $data['entity_long'] =$inputData['entity_long'];
            $data['geofencing'] =$inputData['geofencing'];
            $data['status_id'] = $inputData['status_id'];
            $data['publish_merchant'] = $inputData['publish_merchant'];
            $data['delivery_type'] = $inputData['delivery_type'];
            $data['delivery_charge'] = $inputData['delivery_charge'];
        //  dd($data);

            if($inputData['branch_uuid'] != ''){
                $entity = EntityBranch::where('uuid', $inputData['branch_uuid'])->first();
                $branch_id = $entity->id;
                $timmings1 =BranchTimmings::where('branch_id',$branch_id)->get();
                if($timmings1 != null){

                 DB::table('branch_timmings')->where('branch_id', $branch_id)->delete();
                }
                if(isset($inputData['sun_start']) || isset($inputData['sun_end'])){

                array_push($timmings, array('day' => 'Sunday' , 'start_time' => Carbon::parse($inputData['sun_start'])->format('H:i'),
                    'end_time'=> Carbon::parse($inputData['sun_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['mon_start']) || isset($inputData['mon_end'])){
                array_push($timmings, array('day' => 'Monday' , 'start_time' => Carbon::parse($inputData['mon_start'])->format('H:i'),
                    'end_time' => Carbon::parse($inputData['mon_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['tue_start']) || isset($inputData['tue_end'])){
                array_push($timmings, array('day' => 'Tuesday' , 'start_time' => Carbon::parse($inputData['tue_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['tue_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['wed_start']) || isset($inputData['wed_end'])){
                array_push($timmings, array('day' => 'Wednesday' , 'start_time' =>Carbon::parse($inputData['wed_start'])->format('H:i'),
                    'end_time'=> Carbon::parse($inputData['wed_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['thus_start']) || isset($inputData['thus_end'])){
                array_push($timmings, array('day' => 'Thursday' , 'start_time' =>Carbon::parse($inputData['thus_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['thus_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['fri_start']) || isset($inputData['fri_end'])){
                array_push($timmings, array('day' => 'Friday' , 'start_time' =>Carbon::parse($inputData['fri_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['fri_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['sat_start']) || isset($inputData['sat_end'])){
                array_push($timmings, array('day' => 'Saturday' , 'start_time' =>Carbon::parse($inputData['sat_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['sat_end'])->format('H:i'), 'branch_id' => $branch_id));

            }
                if($timmings1 != null){
                       BranchTimmings::insert($timmings);
                }

                $result = $entity->update($data);

                 if (isset($inputData['header']) && $inputData['header'] !='') {

                          $image = $inputData['header'];
                        $header=$image->getClientOriginalName();
                        $destinationPath = public_path('images/entitybranch');
                       $image->move($destinationPath, $header);

                          DB::table('entitybranch_pictures')->where('branch_id', $branch_id)->where('type','Header')->delete();

                       $branchpic = new BranchPictures();
                       $pic_data['branch_id'] = $branch_id;
                       $pic_data['picture'] = $header;
                       $pic_data['type'] = 'Header';

                       $branchpic->create($pic_data);
                     }

                   if (isset($inputData['pictures']) && $inputData['pictures'] !='') {

                     DB::table('entitybranch_pictures')->where('branch_id', $branch_id)->where('type','Gallery')->delete();
                     foreach($inputData['pictures'] as $image)
                      {

                        $name=$image->getClientOriginalName();
                        $destinationPath = public_path('images/entitybranch');
                        $image->move($destinationPath, $name);

                       $branchpic = new BranchPictures();
                       $pic_data['branch_id'] = $branch_id;
                       $pic_data['picture'] = $name;
                       $pic_data['type'] = 'Gallery';

                       $branchpic->create($pic_data);
                    }
                }


                if($result)
                {
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{
                $entity = new EntityBranch();
                $data['uuid'] = Str::uuid(40)->toString();
              //   dd($data);
                $result = $entity->create($data);
               // dd($result);
                $branch_id = $result->id;

                  if(isset($inputData['sun_start']) || isset($inputData['sun_end'])){
                array_push($timmings, array('day' => 'Sunday' , 'start_time' =>Carbon::parse($inputData['sun_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['sun_end'])->format('H:i'), 'branch_id' => $branch_id));

            }
            if(isset($inputData['mon_start']) || isset($inputData['mon_end'])){
                array_push($timmings, array('day' => 'Monday' , 'start_time' =>Carbon::parse($inputData['mon_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['mon_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['tue_start']) || isset($inputData['tue_end'])){
                array_push($timmings, array('day' => 'Tuesday' , 'start_time' =>Carbon::parse($inputData['tue_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['tue_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['wed_start']) || isset($inputData['wed_end'])){
                array_push($timmings, array('day' => 'Wednesday' , 'start_time' =>Carbon::parse($inputData['wed_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['wed_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['thus_start']) || isset($inputData['thus_end'])){
                array_push($timmings, array('day' => 'Thursday' , 'start_time' => date("h:i", strtotime( $inputData['thus_start'] )),
                    'end_time'=> date("h:i", strtotime( $inputData['thus_end'] )), 'branch_id' => $branch_id));
            }
             if(isset($inputData['fri_start']) || isset($inputData['fri_end'])){
                array_push($timmings, array('day' => 'Friday' , 'start_time' =>Carbon::parse($inputData['fri_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['fri_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
             if(isset($inputData['sat_start']) || isset($inputData['sat_end'])){
                array_push($timmings, array('day' => 'Saturday' , 'start_time' =>Carbon::parse($inputData['sat_start'])->format('H:i'),
                    'end_time'=>Carbon::parse($inputData['sat_end'])->format('H:i'), 'branch_id' => $branch_id));
            }
                if($timmings != null){
                       BranchTimmings::insert($timmings);
                }


                   if (isset($inputData['header']) && $inputData['header'] !='') {

                        $image = $inputData['header'];
                        $header=$image->getClientOriginalName();
                       $image->move(public_path().'images/entitybranch', $header);



                       $branchpic = new BranchPictures();
                       $pic_data['branch_id'] = $branch_id;
                       $pic_data['picture'] = $header;
                       $pic_data['type'] = 'Header';

                       $branchpic->create($pic_data);
                     }

                   if (isset($inputData['pictures']) && $inputData['pictures'] !='') {

                     foreach($inputData['pictures'] as $image)
                      {

                        $name=$image->getClientOriginalName();
                       $image->move(public_path().'images/entitybranch', $name);



                       $branchpic = new BranchPictures();
                       $pic_data['branch_id'] = $branch_id;
                       $pic_data['picture'] = $name;
                       $pic_data['type'] = 'Gallery';

                       $branchpic->create($pic_data);
                    }
                }

                if($result)
                {
                    return 1;
                }
                else{
                    return 0;
                }

            }

        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function getAllServices($type){

        try {

            return Services::where('type',$type)->get();

        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }


        public function getEntityBranch($uuid){

            try {

               return EntityBranch::where('uuid',$uuid)->with('Entity','Pictures','Timmings')->first();

            }catch (\Exception $e){
                return $e->getMessage();
            }
        }

    public function getCitiesByCountry($id){

        $cities =City::where('country_id',$id)->orderBy('name','ASC')->get();
        return $cities;
    }


    public function getAllAffiliates(){

     return Affiliate::all();
    }

    public function getAllEntitiesofAffiliate(){

        $list = EntityBranch::where('affiliate_id', \Auth::guard('affiliate')->user()->affiliate_id)->with('Affiliate')->get();

        $mainlist = $list->toArray();
        $affiliates = Affiliate::where('parent_id',\Auth::guard('affiliate')->user()->affiliate_id)->get();
        //dd(\Auth::guard('affiliate')->user(),$mainlist, $affiliates);
        $subids= [];
        if($affiliates != null){
            foreach ($affiliates as $value) {
           // dd($value->id);
            $list2 =EntityBranch::where('affiliate_id',$value->id)->with('Affiliate')->first();
            if($list2 != null){
                 array_push($subids,$value->id);
           array_push($mainlist, $list2->toArray());
            }
           // dd($list2->toArray());

        }
        }
        //dd($mainlist,$subids);
        foreach ($subids as $value1) {
           // dd($value1);
            $affi = Affiliate::where('parent_id',$value1)->get();
            if($affi != null){
            foreach ($affi as $value) {

            $list2 =EntityBranch::where('affiliate_id',$value->id)->with('Affiliate')->first();
            if($list2 != null){
                array_push($subids,$value->id);
            array_push($mainlist, $list2->toArray());
            }

        }
        }
        }

      //  dd($mainlist);
        return $mainlist;

    }


    public function getEntityBranchBySlug($slug){

    try{
          $result = EntityBranch::where('slug', $slug)->with('Pictures')->first();
          return $result;
    }catch (\Exception $e){
                return $e->getMessage();
            }


   }

   public function getAllProductsCat($entity_id){

    try{
          $result = ProductCategories::where('entity_id', $entity_id)->where('status',1)->orderBy('order_by', 'ASC')->get();
          return $result;
    }catch (\Exception $e){
                return $e->getMessage();
            }
   }


   public function getEntityBranchById($id)
   {

    $result = EntityBranch::where('id',$id)->first();
    return $result;
   }
}


?>
