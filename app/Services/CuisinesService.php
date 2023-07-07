<?php




namespace App\Services;
use  App\Model\Cuisines;
use Carbon\Carbon;
use Illuminate\Support\Str;






class CuisinesService
{
    public function SaveCuisines($inputData)
    {



    try{

        $Cuisines = new Cuisines();
            if(isset($inputData['cuisines_id'])){
                $Cuisines->where('uuid',$inputData['cuisines_id'])
                    ->update([
                        'name' => $inputData['cuisines'],
                        'status' => $inputData['status'],
                        'updated_at' =>Carbon::now()
                    ]);
            }else{
                $check= Cuisines::where('name', $inputData['cuisines'])->exists();
                if($check !=true){
                    $Cuisines->name=$inputData['cuisines'];
                    $Cuisines->status=$inputData['status'];
                    $Cuisines->uuid=Str::uuid();
                    $Cuisines->save();
                }else
                {
                    return "Same Cuisines Name Already Exists";
                }

            }

        if($Cuisines && isset($request->cuisines_id)){
            $msg="Cuisines updated successfully";
        }else
        {
            $msg="Cuisines Created successfully";
        }
        return $msg;
        }catch (\Exception $e) {

            return $e->getMessage();
        }


    }


    public function CuisinesList(){

        try{
            return Cuisines::all();
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function EditCuisines($id){

        try{
            $Cuisines = Cuisines::where('uuid',$id)->first();
            return $Cuisines;
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function DeleteCuisines($id){
        try{
            $Cuisines= Cuisines::where('uuid',$id)->delete();
            return $Cuisines;
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

}
