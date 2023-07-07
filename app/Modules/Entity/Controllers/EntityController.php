<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Carbon\Carbon;
use App\User;
use App\Services\EntitiesService;
use App\Services\CategoryService;
use App\Services\CuisinesService;
class EntityController extends Controller
{

    protected $EntitiesService;
    protected $CategoriesService;
     protected $CuisinesService;
    public function __construct(EntitiesService $EntitiesService , CategoryService $CategoriesService , CuisinesService $CuisinesService) {
        $this->EntitiesService = $EntitiesService;
        $this->CategoriesService = $CategoriesService;
          $this->CuisinesService = $CuisinesService;
    }
    public function index(){
        $entity = Entities::where('id',\Auth::guard('entity')->user()->entity_id)->with('Category')->first();
        $uuid = $entity->uuid;
        $data = $this->EntitiesService->getAllEntityBranches($uuid);
        //dd($branches);
        return view('Entity::Entity.index' , compact('data','entity'));
    }

     public function ViewAddForm($uuid){
            $entity = $this->EntitiesService->getEntity($uuid);
            $services = $this->EntitiesService->getAllServices('Entity');
            $cuisines= $this->CuisinesService->CuisinesList();
          //  dd($entity,$services,$cuisines);
        return view('Entity::Entity.view_form' , compact('entity','services','cuisines'));
    }
   
   public function saveEntityBranchdata(Request $request){

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

}
