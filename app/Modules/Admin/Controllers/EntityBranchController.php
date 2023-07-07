<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Countires;
use App\Model\Status;
use App\Model\Tags;
use App\Services\CuisinesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Carbon\Carbon;
use App\User;
use App\Services\EntitiesService;
use App\Services\CategoryService;

class EntityBranchController extends Controller
{

    protected $EntitiesService;
    protected $CategoriesService;
    protected $CuisinesService;

    public function __construct(EntitiesService $EntitiesService , CategoryService $CategoriesService , CuisinesService $CuisinesService) {
        $this->EntitiesService = $EntitiesService;
        $this->CategoriesService = $CategoriesService;
        $this->CuisinesService = $CuisinesService;
    }

    public function ViewEntityBranches($uuid){

     $data = $this->EntitiesService->getAllEntityBranches($uuid);

    // dd($data);
        return view('Admin::EntityBranches.index' , compact('data'));
    }

     public function ViewAddForm($uuid){
            $status =Status::where('type', 'Entity')->get();
           $tags = Tags::where('status',1)->get();
            $tagsArray =[];
             $cuisinesArray =[];
              $countries = Countires::all();
            $entity = $this->EntitiesService->getEntity($uuid);
            $services = $this->EntitiesService->getAllServices('Entity');
            $cuisines= $this->CuisinesService->CuisinesList();
            $affiliates = $this->EntitiesService->getAllAffiliates();
        return view('Admin::EntityBranches.view_form' , compact('entity','affiliates','services','cuisines','cuisinesArray','countries','status','tags','tagsArray'));
    }

    public function ViewEditForm($uuid){
        $entity = $this->EntitiesService->getEntityBranch($uuid);
         $branch_uuid= $entity->uuid;
         $entity->uuid = $entity->Entity->uuid;
         $entity->branch_uuid = $branch_uuid;
         $cuisinesArray =[];
         $affiliates = $this->EntitiesService->getAllAffiliates();
         if($entity->cuisines != null)
         {
             $cuisinesArray =json_decode($entity->cuisines,true);
         }
         $timmings =[];
         if($entity->Timmings != null){

            foreach ($entity->Timmings as $time) {

                if($time->day == 'Sunday'){
                     $timmings['sun_start'] = date("g:i a", strtotime($time->start_time));
                     $timmings['sun_end'] =date("g:i a", strtotime($time->end_time));
                }
                 if($time->day == 'Monday'){
                     $timmings['mon_start'] = date("g:i a", strtotime($time->start_time));
                     $timmings['mon_end'] = date("g:i a", strtotime($time->end_time));
                }
                 if($time->day == 'Tuesday'){
                     $timmings['tue_start'] = date("g:i a", strtotime($time->start_time));
                     $timmings['tue_end'] = date("g:i a", strtotime($time->end_time));
                }
                 if($time->day == 'Wednesday'){
                     $timmings['wed_start'] =  date("g:i a", strtotime($time->start_time));
                     $timmings['wed_end'] = date("g:i a", strtotime($time->end_time));
                }
                 if($time->day == 'Thursday'){
                     $timmings['thus_start'] = date("g:i a", strtotime($time->start_time));
                     $timmings['thus_end'] = date("g:i a", strtotime($time->end_time));
                }
                 if($time->day == 'Friday'){
                     $timmings['fri_start'] = date("g:i a", strtotime($time->start_time));
                     $timmings['fri_end'] = date("g:i a", strtotime($time->end_time));
                }
                 if($time->day == 'Saturday'){
                     $timmings['sat_start'] = date("g:i a", strtotime($time->start_time));
                     $timmings['sat_end'] = date("g:i a", strtotime($time->end_time));
                }

            }
         }
         $tagsArray =[];
         if($entity->tags != null){
          $tagsArray =json_decode($entity->tags,true);
         }
         $header ='';
         $Gallery = [];
         foreach ($entity->Pictures as $Picture) {

            if($Picture->type == 'Header')
            {
              $header = $Picture->picture;
            }
            else if($Picture->type == 'Gallery')
            {
              array_push($Gallery, $Picture->picture);
            }
         }
        $countries = Countires::all();
        $tags = Tags::where('status',1)->get();
        $status =Status::where('type', 'Entity')->get();
        $contact =[];
        $contact = json_decode($entity->contact,true);
        $address =[];
        $address = json_decode($entity->address,true);

       // dd($contact, $address);

        $services = $this->EntitiesService->getAllServices('Entity');
        $cuisines= $this->CuisinesService->CuisinesList();
       // dd($entity , $services , $cuisines);
        return view('Admin::EntityBranches.view_form' , compact('entity','timmings','affiliates','services','cuisines','header','Gallery','contact','countries','address','tags','tagsArray','status','cuisinesArray'));
    }
     public function saveEntityBranchdata(Request $request){
      //  dd($request->all());
          $inputData = $request->all();
          if($request->branch_uuid == "")
          $inputData['branch_uuid'] = '';
          $result =  $this->EntitiesService->SaveEntityBranch($inputData);
       // dd($result);
            if($result == 1){
                $msg = "Successfully Added Entity !!";
            }
         return redirect()->back()->with('success', $msg);
    }
    public function  getCities(Request $request){
        $c_id = $request->id;

        $cities = $this->EntitiesService->getCitiesByCountry($c_id);
        echo json_encode($cities);
    }

   public function DeleteEntity($uuid){

       $result = $this->EntitiesService->DeleteEntityBranch($uuid);

          if($result == 1){
                $msg = "Entity deleted Successfully !!";
            }
            return redirect()->back()->with('success', $msg);
   }

   
}
