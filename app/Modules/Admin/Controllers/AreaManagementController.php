<?php


namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaManagementRequest;
use App\Model\Countires;
use App\Services\AreaManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\CategoryService;


class AreaManagementController extends Controller
{
    protected $AreaManagementService;

    public function __construct(AreaManagementService $AreaManagementService)
    {
        $this->AreaManagementService = $AreaManagementService;
    }

    public function index()
    {
        $AreaManagement_list= $this->AreaManagementService->AreaManagementList();

        return view('Admin::AreaManagement.index')->with('lists', $AreaManagement_list);
    }
    public function show()
    {
        $category_list= $this->CategoryService->CategoryList();

        return view('Admin::categories.category_list')->with('lists', $category_list);
    }

    public function create()
    {
        $countries = Countires::all();
        return view('Admin::AreaManagement.view_form',compact('countries',$countries));
    }

    public function store(Request $request)
    {
        $validator = AreaManagementRequest::validator($request->all())->validate();
        $result=$this->AreaManagementService->SaveAreaManagement($request->all());
        return redirect()->back()->with('success', $result);
    }
    public function area_management_edit($id)
    {
        $AreaManagementService=$this->AreaManagementService->EditAreaManagement($id);
        $countries = Countires::all();
        return view('Admin::AreaManagement.view_form',compact('AreaManagementService',$AreaManagementService ,'countries',$countries));
    }
    public function area_management_delete($id)
    {
        $result=  $this->AreaManagementService->Delete_area_management($id);
        return redirect()->back()->with('success', $result);
    }


}



