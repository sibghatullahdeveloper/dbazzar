<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Entities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Carbon\Carbon;
use App\User;
use App\Services\EntitiesService;
use App\Services\CategoryService;

class EntityController extends Controller
{

    protected $EntitiesService;
    protected $CategoriesService;
    public function __construct(EntitiesService $EntitiesService , CategoryService $CategoriesService) {
        $this->EntitiesService = $EntitiesService;
        $this->CategoriesService = $CategoriesService;
    }
    public function index(){

       $entities = $this->EntitiesService->getAllEntities();

        return view('Admin::Entities.index' , compact('entities'));
    }
    public function ViewAddForm(){

        $catorgies = $this->CategoriesService->CategoryList();
        return view('Admin::Entities.view_form' , compact('catorgies'));
    }
    public function saveEntitydata(Request $request){
        //dd($request->all());
     $validator = $request->validate([
                'entity_cat' => 'required',
                'entity_name' => 'required',
                'entity_email' =>'required'

            ]);
          $inputData = $request->all();
          if($request->uuid == "")
          $inputData['uuid'] = '';
          $result =  $this->EntitiesService->SaveEntity($inputData);

            if($result == 1){
                $msg = "Successfully Added Entity !!";
            }
         return redirect()->back()->with('success', $msg);
    }

    public function ViewEditForm($uuid){
            $entity = $this->EntitiesService->getEntity($uuid);

            $catorgies = $this->CategoriesService->CategoryList();
            return view('Admin::Entities.view_form' , compact('catorgies', 'entity'));
    }

    public function DeleteEntity($uuid){

        $result = $this->EntitiesService->DeleteEntity($uuid);

          if($result == 1){
                $msg = "Entity deleted Successfully !!";
            }
            return redirect()->back()->with('success', $msg);
    }

    public function ViewEntityBranches($uuid){

        $branches = $this->EntitiesService->getAllEntityBranches($uuid);

        return view('Admin::EntityBranches.index' , compact('branches'));
    }

    public function AutoLoginEntity($uuid){
        //dd($uuid);
        $entity = Entities::where('uuid', $uuid)->first();

        $usercredentials = User::where('entity_id', $entity->id)->first();
        if($usercredentials == null){
            return redirect()->back();
        }
        $email = $usercredentials->email;
        $password = $usercredentials->password;

        $userObj = User::whereEmail($email)
            ->where('password' , $password)
            ->where("email_verified","=",1)
            ->whereRaw(" ( user_type = 'ENTITYADMIN' ) ")
            ->first();

        if ( empty($userObj)  ) {
            // $this->incrementLoginAttempts($request);
            return redirect(route("entity.signin"))->with('error', 'User Credentials Not Found.');
        }

        $remember = 0;
        \Auth::guard('entity')->login($userObj, $remember);

        return redirect(route('entity.dashboard'));
    }
}
