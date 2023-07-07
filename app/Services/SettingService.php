<?php


namespace App\Services;
use App\Model\Entities;
use App\Model\EntitiesSettings;
use App\Model\Settings;
use Carbon\Carbon;
use Illuminate\Support\Str;


class SettingService
{
    public function SaveSetting($inputData)
    {


        try{
            $Settings = new Settings();
            $data['status']=$inputData['status'];
            if(isset($inputData['settings_uuid'])){
                $entity = $Settings::where('uuid', $inputData['settings_uuid'])->first();
                $result = $entity->update($data);
                if($result)
                {
                    return ' Settings Updated Successfully';
                }
                else{
                    return ' Settings Not Updated ';
                }
            }else
            {
                $data['uuid'] = Str::uuid(40)->toString();
                $result = $Settings->create($data);
                if($result)
                {
                    return ' Settings Created Successfully';
                }
                else{
                    return 'Entity Settings Not Created ';
                }
            }

        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function GetSettings(){
        try {
            return  Settings::first();
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }



}



