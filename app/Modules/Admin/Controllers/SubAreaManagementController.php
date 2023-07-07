<?php


namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaManagementRequest;
use App\Http\Requests\Admin\SubManagementRequest;
use App\Model\Countires;
use App\Services\AreaManagementService;
use App\Services\SubAreaManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\CategoryService;


class SubAreaManagementController extends Controller
{
    protected $AreaManagementService;
    protected $SubManagementService;

    public function __construct(SubAreaManagementService $SubManagementService , AreaManagementService $AreaManagementService)
    {
        $this->SubManagementService = $SubManagementService;
        $this->AreaManagementService = $AreaManagementService;
    }

    public function index($uuid)
    {
        $lists= $this->SubManagementService->SubAreaManagementList($uuid);
        $area_management= $this->SubManagementService->AreaManagement($uuid);
        return view('Admin::SubAreaManagement.index',compact('lists',$lists ,'area_management',$area_management));
    }
    public function show()
    {
        $category_list= $this->CategoryService->CategoryList();
        return view('Admin::categories.category_list')->with('lists', $category_list);
    }
    public function create($uuid)
    {
        $lists= $this->SubManagementService->AreaManagement($uuid);
        return view('Admin::SubAreaManagement.view_form',compact('lists',$lists));
    }

    public function store(Request $request)
    {

        $validator = SubManagementRequest::validator($request->all())->validate();
        $result=$this->SubManagementService->SaveSubAreaManagement($request->all());
        return redirect()->back()->with('success', $result);
    }
    public function sub_area_management_edit($id,$uuid)
    {

        $SubAreaManagement=$this->SubManagementService->EditSubAreaManagement($id);
        $lists= $this->SubManagementService->AreaManagement($uuid);
        return view('Admin::SubAreaManagement.view_form',compact('SubAreaManagement',$SubAreaManagement ,'lists',$lists ));
    }
    public function sub_area_management_delete($id)
    {
        $result=  $this->SubManagementService->Delete_sub_area_management($id);
        return redirect()->back()->with('success', $result);
    }


}



