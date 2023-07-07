<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SponsoredRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\SponsoredService;
use App\Services\EntitiesService;


class SponsoredController extends Controller
{
    protected $SponsoredService;
    protected $EntitiesService;

    public function __construct(SponsoredService $SponsoredService ,EntitiesService  $EntitiesService)
    {
        $this->SponsoredService = $SponsoredService;
        $this->EntitiesService = $EntitiesService;
    }

        public function index()
        {
            $sponsored_list= $this->SponsoredService->SponsoredList();
            //dd($sponsored_list);

            return view('Admin::sponsored.index')->with('lists', $sponsored_list);
        }
        public function show()
        {

            $category_list= $this->CategoryService->getAllEntitiesIndex();
            return view('Admin::categories.category_list')->with('lists', $category_list);
        }

        public function create()
        {
            $items=$this->EntitiesService->getAllBranches();

            return view('Admin::sponsored.view_form',compact('items',$items));
        }

        public function store(Request $request)
        {
            //dd($request);
            //$validator = SponsoredRequest::validator($request->all())->validate();
            $result=$this->SponsoredService->SaveSponsored($request->all());
            
            if($result && isset($request->cat_id)){
               $msg="Sponsored updated successfully";
            }elseif($result)
            {
               $msg="Sponsored Created successfully";
            }

            return redirect()->back()->with('success', $msg);
        }
        public function sponsored_edit($id)
        {
            $sponsored=$this->SponsoredService->EditSponsored($id);
            $items=$this->EntitiesService->getAllBranches();

            return view('Admin::sponsored.view_form',compact('items',$items ,'sponsored' ,$sponsored));

        }
        public function sponsored_delete($id)
        {

            $result=  $this->SponsoredService->DeleteSponsore($id);

            return redirect()->back()->with('success', $result);
        }


}



