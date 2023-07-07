<?php


namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CuisinesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\CuisinesService;


class CuisinesController extends Controller
{
    protected $CuisinesService;

    public function __construct(CuisinesService $CuisinesService)
    {
        $this->CuisinesService = $CuisinesService;
    }

    public function index()
    {
        $Cuisines_list= $this->CuisinesService->CuisinesList();
        return view('Admin::cuisines.index')->with('lists', $Cuisines_list);
    }
    public function show()
    {
        $category_list= $this->CategoryService->CategoryList();

        return view('Admin::categories.category_list')->with('lists', $category_list);
    }

    public function create()
    {
        return view('Admin::cuisines.view_form');
    }

    public function store(Request $request)
    {


        $validator = CuisinesRequest::validator($request->all())->validate();
        $result=$this->CuisinesService->SaveCuisines($request->all());

        return redirect()->back()->with('success', $result);
    }
    public function Cuisines_edit($id)
    {

        $cuisines=$this->CuisinesService->EditCuisines($id);

        return view('Admin::cuisines.view_form')->with('cuisines', $cuisines);
    }
    public function Cuisines_delete($id)
    {
        $result= $this->CuisinesService->DeleteCuisines($id);
        if($result ){
            $msg="Cuisines remove successfully";
        }elseif($result)
        {
            $msg="Cuisines Not remove";
        }

        return redirect()->back()->with('success', $msg);
    }


}



