<?php


namespace App\Services;
use App\Model\AreaManagement;

use App\Model\SubAreaManagement;
use Carbon\Carbon;
use Illuminate\Support\Str;


class AreaManagementService
{
    public function SaveAreaManagement($inputData)
    {
        try{
            $AreaManagement= new AreaManagement();

            $data['name']=$inputData['name'];
            $data['status']=$inputData['status'];
            $data['city_id']=$inputData['city_id'];
            $data['country_id']=$inputData['country_id'];

            if(isset($inputData['uuid'])){
                $data['updated_at']=Carbon::now();
                $area = AreaManagement::where('uuid', $inputData['uuid'])->first();
                $result = $area->update($data);
                if($result)
                {
                    $msg='Area Manager Updated successfully';
                }else
                {
                    $msg='Area Manager not Updated ';
                }

            }else{
                $data['uuid'] = Str::uuid(40)->toString();
                $result = $AreaManagement->create($data);
                if($result)
                {
                 $msg='Area Manager created successfully';
                }else
                {
                    $msg='Area Manager not created ';
                }

            }
            return $msg;

        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function AreaManagementList(){
        try {
            return AreaManagement::with('City')->with('Countires')->get();
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function AreaManagement($uuid){
        try{
            $items = AreaManagement::where('uuid',$uuid)->select('id', 'name')->first();
            return $items;
        }  catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function Delete_area_management($id){
        try{
            $AreaManagement= AreaManagement::where('id',$id)->delete();
            $SubAreaManagement= SubAreaManagement::where('area_manager_id',$id)->delete();
            if($SubAreaManagement ){
                $msg="Area Manager remove successfully";
            }else
            {
                $msg="Area Manager Not remove";
            }
            return  $msg;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function EditAreaManagement($id){

        try{
            $AreaManagement= AreaManagement::where('uuid',$id)->first();
            return  $AreaManagement;
        }
        catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getAllAreas(){

        return AreaManagement::get();
    }
}



