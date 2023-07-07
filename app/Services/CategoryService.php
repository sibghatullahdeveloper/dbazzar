<?php


namespace App\Services;
use App\Model\Categories;
use Carbon\Carbon;
use Illuminate\Support\Str;


class CategoryService
{
    public function SaveCategory($inputData)
    {
        try{
            $category = new Categories();


            if(isset($inputData['cat_id'])){
                $category->where('uuid',$inputData['cat_id'])
                    ->update([
                        'name' => $inputData['category'],
                        'status' => $inputData['status'],
                        'updated_at' =>Carbon::now()
                    ]);
            }else{
               $check= Categories::where('name', $inputData['category'])->exists();
                if($check !=true){
                    $category->name=$inputData['category'];
                    $category->status=$inputData['status'];
                    $category->uuid=Str::uuid();
                    $category->save();
                }else
                {
                    return "Category Already Exists";
                }

            }

            if($category && isset($request->cat_id)){
                $msg="Category updated successfully";
            }else
            {
                $msg="Category Created successfully";
            }
            return $msg;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function CategoryList(){
        try {
            return Categories::all();
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function DeleteCategory($id){
        try{
            $Categories = Categories::where('uuid',$id)->delete();
            return  $Categories;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function EditCategory($id){

          try{
              $Categories = Categories::where('uuid',$id)->first();
              return  $Categories;
          }
        catch (\Exception $e) {

                return $e->getMessage();
            }
    }
}



