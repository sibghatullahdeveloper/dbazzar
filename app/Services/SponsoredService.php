<?php
namespace App\Services;
use  App\Model\Sponsored;
use  App\Model\Entities;
use  App\Model\EntityBranch;
use Carbon\Carbon;
use Illuminate\Support\Str;



class SponsoredService
{
    public function SaveSponsored($inputData)
    {

        try{

            $Sponsored = new Sponsored();

            if(isset($inputData['sponsored_id'])){
                $Sponsored->where('uuid',$inputData['sponsored_id'])
                    ->update([
                        'entity_branch_id' => $inputData['entity_branch_id'],
                        'status' => $inputData['status'],
                        'start_date' => $inputData['start_date'],
                        'end_date' => $inputData['end_date'],
                        'updated_at' =>Carbon::now()
                    ]);
            }else{
                $Sponsored->entity_branch_id=$inputData['entity_branch_id'];
                $Sponsored->status=$inputData['status'];
                $Sponsored->start_date=$inputData['start_date'];
                $Sponsored->end_date=$inputData['end_date'];
                $Sponsored->uuid=Str::uuid();
                $Sponsored->save();
            }

            return true;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function SponsoredList(){
        try {

         return Sponsored::with('entitybranches')->paginate(50);

        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function DeleteSponsore($id){
        try{
            $Sponsored = Sponsored::where('uuid',$id)->delete();
            if($Sponsored ){
                $msg="Sponsored remove successfully";
            }else
            {
                $msg="Sponsored Not remove";
            }
            return $msg;
        }catch (\Exception $e) {

            return $e->getMessage();
        }

    }
    public function EditSponsored($id){

        try{
            $Sponsored = Sponsored::where('uuid',$id)->first();
            return  $Sponsored;
        }
        catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
