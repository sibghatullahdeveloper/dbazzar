<?php


namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\CategoryService;


class CategoryController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    public function index()
    {
        $category_list= $this->CategoryService->CategoryList();
        return view('Admin::categories.index')->with('lists', $category_list);
    }
    public function show()
    {
      $category_list= $this->CategoryService->CategoryList();

        return view('Admin::categories.category_list')->with('lists', $category_list);
    }

    public function create()
    {
    return view('Admin::categories.view_form');
    }

    public function store(Request $request)
    {

        $validator = CategoryRequest::validator($request->all())->validate();

        $result=$this->CategoryService->SaveCategory($request->all());
        return redirect()->back()->with('success', $result);
    }
    public function Category_edit($id)
    {
        $category=$this->CategoryService->EditCategory($id);

        return view('Admin::categories.view_form')->with('category', $category);
    }
    public function Category_delete($id)
    {

        $result=  $this->CategoryService->DeleteCategory($id);
        if($result ){
            $msg="Category remove successfully";
        }elseif($result)
        {
            $msg="Category Not remove";
        }
        return redirect()->back()->with('success', $msg);
    }


}



