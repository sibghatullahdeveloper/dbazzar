<?php


namespace App\Services;
use App\Model\AreaManagement;

use App\Model\SubAreaManagement;
use Carbon\Carbon;
use Illuminate\Support\Str;


class SubAreaManagementService
{
    public function SaveSubAreaManagement($inputData)
    {

        try{
            $SubAreaManagement= new SubAreaManagement();
            $data['name']=$inputData['name'];
            $data['status']=$inputData['status'];
            $data['area_manager_id']=$inputData['area_id'];

            if(isset($inputData['sub_area_id'])){
                $data['updated_at']=Carbon::now();
                $area = SubAreaManagement::where('uuid', $inputData['sub_area_id'])->first();

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
                $result = $SubAreaManagement->create($data);
                if($result)
                {
                    $msg='Sub Area created successfully';
                }else
                {
                    $msg='Sub Area not created ';
                }
            }
            return $msg;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function SubAreaManagementList($uuid){
        try {
            $id=AreaManagement::where('uuid',$uuid)->value('id');

            return SubAreaManagement::where('area_manager_id',$id)->with('AreaManagement')->get();
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function AreaManagement($uuid){
        try{
            $items = AreaManagement::where('uuid',$uuid)->select('id', 'name','uuid')->first();
            return $items;
        }  catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function Delete_sub_area_management($id){
        try{
            $AreaManagement= SubAreaManagement::where('uuid',$id)->delete();
            if($AreaManagement ){
                $msg="Sub Area Manager remove successfully";
            }else
            {
                $msg="Sub Area Manager Not remove";
            }
            return  $msg;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function EditSubAreaManagement($id){

        try{
            $AreaManagement= SubAreaManagement::where('uuid',$id)->first();
            return  $AreaManagement;
        }
        catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getSubAreaById($id){

        try {

            return SubAreaManagement::where('area_manager_id',$id)->select('id', 'name','uuid')->get();
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}



