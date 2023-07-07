<?php


namespace App\Services;
use App\Model\Entities;
use App\Model\EntitiesSettings;
use Carbon\Carbon;
use Illuminate\Support\Str;


class EntitiesSettingService
{
    public function SaveEntitiesService($inputData)
    {


        try{
             $EntitiesSettings = new EntitiesSettings();
             if($inputData['branch_id'] == null){
                return 'Please Select A branch';
             }
            if(isset($inputData['entity_setting_id'])==false && $EntitiesSettings->where('entity_id',$inputData['entity_id'])->where('branch_id',$inputData['branch_id'])->where('deleted_at',null)->exists()){
                return 'Entity Settings Already Exits';
            }
            $data['branch_id'] =$inputData['branch_id'];
            $data['entity_id']=$inputData['entity_id'];
            $data['order_type']=$inputData['order_type'];
            $data['commission']=$inputData['commission'];
            $data['minimum_purchase']=$inputData['minimum_purchase'];
            $data['About']=$inputData['About'];
            $data['status']=$inputData['status'];
            $data['status_message']=$inputData['status_message'];
            $data['packaging_type']=$inputData['packaging_type'];
            $data['packaging_charge']=$inputData['packaging_charge'];
            $data['tax']=$inputData['tax'];
            $data['delivery_time']=$inputData['delivery_time'];
            $data['menu_type']=$inputData['menu_type'];

            if (isset($inputData['logo']) &&$inputData['logo'] !='') {
                $files = $inputData['logo'];
                $destinationPath = public_path('images/entity');
                $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $logo);
                $data['logo']="$logo";
            }
            if (isset($inputData['header'])&&$inputData['header'] !='') {
                $files = $inputData['header'];
                $destinationPath = public_path('images/entity');
                $header = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $header);
                $data['header']="$header";
            }


            if(isset($inputData['entity_setting_id'])){
                $entity = $EntitiesSettings::where('uuid', $inputData['entity_setting_id'])->first();
                $result = $entity->update($data);
                if($result)
                {
                    return 'Entity Settings Updated Successfully';
                }
                else{
                    return 'Entity Settings Not Updated ';
                }
            }else
            {
                $data['uuid'] = Str::uuid(40)->toString();
                $result = $EntitiesSettings->create($data);
                if($result)
                {
                    return 'Entity Settings Created Successfully';
                }
                else{
                    return 'Entity Settings Not Created ';
                }
            }

        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function EntitiesSettingList($entity_id){
        try {
            return EntitiesSettings::where('entity_id',$entity_id)->with('entity')->get();
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function Delete_entity_settings_delete($id){
        try{
            $result = EntitiesSettings::where('uuid',$id)->delete();
            if($result ){
                return "Entity Settings remove successfully";
            }elseif($result)
            {
                return "Entity Settings Not remove";
            }

        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function EditEntitiesSettingService($id){

        try{
            $entity_id=Entities::where('uuid',$id)->value('id');

            $check=  EntitiesSettings::where('entity_id', '=',$entity_id)->exists();
            if($entity_id && $check)
            {
                $EntitiesSettings = EntitiesSettings::where('entity_id',$entity_id)->with('entity')->first();
            }else
            {
                $EntitiesSettings = Entities::where('uuid',$id)->first();

            }

            return  $EntitiesSettings;
        }
        catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getEntityBranchSettings($id){



        return EntitiesSettings::where('branch_id',$id)->first();
    }
}



