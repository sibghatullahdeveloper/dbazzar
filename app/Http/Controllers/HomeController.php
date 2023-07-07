<?php

namespace App\Http\Controllers;

use App\Model\EntityBranch;
use App\Model\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\SponsoredService;
use App\Model\BranchPictures;
use App\Model\BranchTimmings;
use App\Model\Sponsored;
use App\Model\City;
use App\Services\EntitiesService;

class HomeController extends Controller
{

    public function __construct(SponsoredService $SponsoredService, EntitiesService $EntitiesService) {

        $this->SponsoredService = $SponsoredService;
        $this->EntitiesService = $EntitiesService;
    }


    public function index(){

    	$sponsored = $this->SponsoredService->SponsoredList();
        //dd($sponsored);
    	foreach ($sponsored as $list){

	       	if($list->entitybranches->tags != null){

	            $tags_array =json_decode($list->entitybranches->tags,true);
	       	   	$tag_name = Tags::select( 'name')
	                ->whereIn('id', $tags_array)
                   	->get();

	               	$list->tags_name=$tag_name;
	        }else{
	            $list->tags_name='';
	        }

            if($list->entitybranches->id != null){

                $id = $list->entitybranches->id;
                $name = BranchPictures::select('picture')
                    ->where('branch_id', $id)
                    ->get();

                    $list->pic_path=$name;
            }else{
                $list->pic_path='';
            }
        }

	   	foreach ($sponsored as $item){

	       	if($item->entity_branch_id != null){

	            $day_today = date('l');
                date_default_timezone_set('Asia/Karachi');
                $current_time = Carbon::now()->format('H:i A');              

	            $id = $item->entity_branch_id;

	       	   	$T = BranchTimmings::select('start_time','end_time')
	                ->where('branch_id', $id)
	                ->where('day', $day_today)
                   	->get();

	               	$item->timings=$T;

	               	foreach ($item->timings as $time) {

                        if($current_time >= $time->start_time && $current_time < $time->end_time ){
                            $item->check = 'Open';
                        }else{
                            $item->check = 'Close';
                        }

                        $time->start_time = date("g:i a", strtotime($time->start_time));
                        $time->end_time = date("g:i a", strtotime($time->end_time));
	   				}

	        }else{
                $item->timings='';
	        }
	   	}
	   	//dd($sponsored);

    	return view('index')->with('sponsored', $sponsored);
    }


    public function browseEntityBranch(){
        
        $EntityBranches = EntityBranch::orderBy('id')->paginate(50);
        foreach ($EntityBranches as $list){

            if($list->tags != null){

                $tags_array =json_decode($list->tags,true);
                $tag_name = Tags::select( 'name')
                    ->whereIn('id', $tags_array)
                    ->get();

                    $list->tags_name=$tag_name;
            }else{
                $list->tags_name='';
            }

            if($list->id != null){

                $id = $list->id;
                $name = BranchPictures::select('picture')
                    ->where('branch_id', $id)
                    ->get();

                    $list->pic_path=$name;
            }else{
                $list->pic_path='';
            }
        }

        foreach ($EntityBranches as $item){

            if($item->id != null){

                $day_today = date('l');
                date_default_timezone_set('Asia/Karachi');
                $current_time = Carbon::now()->format('H:i A');              

                $id = $item->id;

                $T = BranchTimmings::select('start_time','end_time')
                    ->where('branch_id', $id)
                    ->where('day', $day_today)
                    ->get();

                    $item->timings=$T;

                    foreach ($item->timings as $time) {

                        if($current_time >= $time->start_time && $current_time < $time->end_time ){
                            $item->check = 'Open';
                        }else{
                            $item->check = 'Close';
                        }

                        $time->start_time = date("g:i a", strtotime($time->start_time));
                        $time->end_time = date("g:i a", strtotime($time->end_time));
                    }

            }else{
                $item->timings='';
            }
        }


        //dd($EntityBranches);
        return view('browse',compact('EntityBranches',$EntityBranches));
    }

    
    function browseEntityBranchAction(Request $request){
         
        if($request->ajax()){
            
            $output = '';
            $query = $request->get('query');
            $city_name = $request->get('city_name');
            
            if($query != ''){

                $city = City::where('name', $city_name)->first();
                //dd($city);
                $city_id = (string)$city->id;

                //dd($query, $city_name, $city_id);

                $EntityBranches = EntityBranch::where('title', 'like', '%'.$query.'%')
                ->whereJsonContains('address', [['city' => $city_id]])
                ->get();
                //dd($EntityBranches);

                foreach ($EntityBranches as $list){

                    if($list->tags != null){

                        $tags_array =json_decode($list->tags,true);
                        $tag_name = Tags::select( 'name')
                            ->whereIn('id', $tags_array)
                            ->get();

                            $list->tags_name=$tag_name;
                    }else{
                        $list->tags_name='';
                    }


                    if($list->id != null){

                        $id = $list->id;
                        $name = BranchPictures::select('picture')
                            ->where('branch_id', $id)
                            ->get();

                            $list->pic_path=$name;
                    }else{
                        $list->pic_path='';
                    }
                }

                foreach ($EntityBranches as $item){

                    if($item->id != null){

                        $day_today = date('l');
                        date_default_timezone_set('Asia/Karachi');
                        $current_time = Carbon::now()->format('H:i A');              

                        $id = $item->id;

                        $T = BranchTimmings::select('start_time','end_time')
                            ->where('branch_id', $id)
                            ->where('day', $day_today)
                            ->get();

                            $item->timings=$T;

                            foreach ($item->timings as $time) {

                                if($current_time >= $time->start_time && $current_time < $time->end_time ){
                                    $item->check = 'Open';
                                }else{
                                    $item->check = 'Close';
                                }

                                $time->start_time = date("g:i a", strtotime($time->start_time));
                                $time->end_time = date("g:i a", strtotime($time->end_time));
                            }

                    }else{
                        $item->timings='';
                    }
                }


                $total_row = $EntityBranches->count();
                
                if($total_row > 0){
                    foreach($EntityBranches as $row){
                        $output .= "
                        <div class='col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12'>
                            <div class='border-r p-3'>

                                <section class='variable-width slider pt-2  tab-slider'>";
                                    foreach($row->pic_path as $pics){
                                    $output .= "<div>
                                        <img src='images/entitybranch/".$pics->picture."'>
                                    </div>";
                                    }
                                $output .= "</section>
                                <h6 class='pt-2'><b>".$row->title."</b></h6>
                                <div class='btn-group btn-group-sm'>";
                                    foreach($row->tags_name as $tags){
                                    $output .= "<button type='button' class='btn btn-dark bs'>".$tags->name."</button>";
                                    }
                                $output .="</div>
                                <br>";
                                foreach($row->timings as $time){
                                $output .="<h6 class='pt-3'><i class='fas fa-star'></i> <b> 4.2</b> <span class='time'>Opens At ".$time->start_time." - RN : ".$row->check."</span> </h6>";
                                }
                            $output .="</div>
                        </div>
                        ";
                    }
                }else{
 
           
                    $output .= '

                    <div class="col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12 ">
                            <div class="border-r p-3">

                                
                                <h6 class="pt-2"><b>No Data Found</b></h6>
                                
                                
                            </div>
                        </div>
                    ';
                }
            
            }else{




                $EntityBranches = EntityBranch::get();

                foreach ($EntityBranches as $list){

                    if($list->tags != null){

                        $tags_array =json_decode($list->tags,true);
                        $tag_name = Tags::select( 'name')
                            ->whereIn('id', $tags_array)
                            ->get();

                            $list->tags_name=$tag_name;
                    }else{
                        $list->tags_name='';
                    }

                    if($list->id != null){

                        $id = $list->id;
                        $name = BranchPictures::select('picture')
                            ->where('branch_id', $id)
                            ->get();

                            $list->pic_path=$name;
                    }else{
                        $list->pic_path='';
                    }
                }

                foreach ($EntityBranches as $item){

                    if($item->id != null){

                        $day_today = date('l');
                        date_default_timezone_set('Asia/Karachi');
                        $current_time = Carbon::now()->format('H:i A');              

                        $id = $item->id;

                        $T = BranchTimmings::select('start_time','end_time')
                            ->where('branch_id', $id)
                            ->where('day', $day_today)
                            ->get();

                            $item->timings=$T;

                            foreach ($item->timings as $time) {

                                if($current_time >= $time->start_time && $current_time < $time->end_time ){
                                    $item->check = 'Open';
                                }else{
                                    $item->check = 'Close';
                                }

                                $time->start_time = date("g:i a", strtotime($time->start_time));
                                $time->end_time = date("g:i a", strtotime($time->end_time));
                            }

                    }else{
                        $item->timings='';
                    }
                }
                $total_row = $EntityBranches->count();
                
                if($total_row > 0){

                    foreach($EntityBranches as $row){
                        $output .= "
                        <div class='col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12'>
                            <div class='border-r p-3'>

                                <section class='variable-width slider pt-2  tab-slider'>";
                                    foreach($row->pic_path as $pics){
                                    $output .= "<div>
                                        <img src='images/entitybranch/".$pics->picture."'>
                                    </div>";
                                    }
                                $output .= "</section>
                                <h6 class='pt-2'><b>".$row->title."</b></h6>
                                <div class='btn-group btn-group-sm'>";
                                    if($row->tags_name != ''){
                                        foreach($row->tags_name as $tags){
                                            $output .= "<button type='button' class='btn btn-dark bs'>".$tags->name."</button>";
                                        }
                                    }
                                $output .="</div>
                                <br>";
                                foreach($row->timings as $time){
                                $output .="<h6 class='pt-3'><i class='fas fa-star'></i> <b> 4.2</b> <span class='time'>Opens At ".$time->start_time." - RN : ".$row->check."</span> </h6>";
                                }
                            $output .="</div>
                        </div>
                        ";
                    }
                }
            }
          
            $EntityBranches = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($EntityBranches);
        }
    }

    function sponsoredAction(Request $request){
         
        if($request->ajax()){
            
            $output = '';
            $query = $request->get('query');
            
            if($query != ''){

                $EB = EntityBranch::select('id')->where('title', 'like', '%'.$query.'%')
                ->get();

                foreach ($EB as $branch) {
                    $id_array[] = $branch->id;
                }

                $sponsored = Sponsored::whereIn('entity_branch_id', $id_array)->with('entitybranches')->get();

                foreach ($sponsored as $list){

                    if($list->entitybranches->tags != null){

                        $tags_array =json_decode($list->entitybranches->tags,true);
                        $tag_name = Tags::select( 'name')
                            ->whereIn('id', $tags_array)
                            ->get();


                            $list->tags_name=$tag_name;
                    }else{
                        $list->tags_name='';
                    }

                    if($list->entitybranches->id != null){

                        $id = $list->entitybranches->id;
                        $name = BranchPictures::select('picture')
                            ->where('branch_id', $id)
                            ->get();

                            $list->pic_path=$name;
                    }else{
                        $list->pic_path='';
                    }
                }

                foreach ($sponsored as $item){

                    if($item->entity_branch_id != null){

                        $day_today = date('l');
                        date_default_timezone_set('Asia/Karachi');
                        $current_time = Carbon::now()->format('H:i A');              

                        $id = $item->entity_branch_id;

                        $T = BranchTimmings::select('start_time','end_time')
                            ->where('branch_id', $id)
                            ->where('day', $day_today)
                            ->get();

                            $item->timings=$T;

                            foreach ($item->timings as $time) {

                                if($current_time >= $time->start_time && $current_time < $time->end_time ){
                                    $item->check = 'Open';
                                }else{
                                    $item->check = 'Close';
                                }

                                $time->start_time = date("g:i a", strtotime($time->start_time));
                                $time->end_time = date("g:i a", strtotime($time->end_time));
                            }

                    }else{
                        $item->timings='';
                    }
                }


                $total_row = $sponsored->count();
                
                if($total_row > 0){
                    foreach($sponsored as $row){
                        $output .= "
                        <div class='col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12'>
                            <div class='border-r p-3'>

                                <section class='variable-width slider pt-2  tab-slider'>";
                                    foreach($row->pic_path as $pics){
                                    $output .= "<div>
                                        <img src='images/entitybranch/".$pics->picture."'>
                                    </div>";
                                    }
                                $output .= "</section>
                                <h6 class='pt-2'><b>".$row->entitybranches->title."</b></h6>
                                <div class='btn-group btn-group-sm'>";
                                    foreach($row->tags_name as $tags){
                                    $output .= "<button type='button' class='btn btn-dark bs'>".$tags->name."</button>";
                                    }
                                $output .="</div>
                                <br>";
                                foreach($row->timings as $time){
                                $output .="<h6 class='pt-3'><i class='fas fa-star'></i> <b> 4.2</b> <span class='time'>Opens At ".$time->start_time." - RN : ".$row->check."</span> </h6>";
                                }
                            $output .="</div>
                        </div>
                        ";
                    }
                }else{
                    $output = '
                    <div class="col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12 ">
                            <div class="border-r p-3">

                                
                                <h6 class="pt-2"><b>No Data Found</b></h6>
                                
                                
                            </div>
                        </div>
                    ';
                }
            
            }else{

                $sponsored = $this->SponsoredService->SponsoredList();

                foreach ($sponsored as $list){

                    if($list->entitybranches->tags != null){

                        $tags_array =json_decode($list->entitybranches->tags,true);
                        $tag_name = Tags::select( 'name')
                            ->whereIn('id', $tags_array)
                            ->get();

                            $list->tags_name=$tag_name;
                    }else{
                        $list->tags_name='';
                    }

                    if($list->entitybranches->id != null){

                        $id = $list->entitybranches->id;
                        $name = BranchPictures::select('picture')
                            ->where('branch_id', $id)
                            ->get();

                            $list->pic_path=$name;
                    }else{
                        $list->pic_path='';
                    }
                }

                foreach ($sponsored as $item){

                    if($item->entity_branch_id != null){

                        $day_today = date('l');
                        date_default_timezone_set('Asia/Karachi');
                        $current_time = Carbon::now()->format('H:i A');              

                        $id = $item->entity_branch_id;

                        $T = BranchTimmings::select('start_time','end_time')
                            ->where('branch_id', $id)
                            ->where('day', $day_today)
                            ->get();

                            $item->timings=$T;

                            foreach ($item->timings as $time) {

                                if($current_time >= $time->start_time && $current_time < $time->end_time ){
                                    $item->check = 'Open';
                                }else{
                                    $item->check = 'Close';
                                }

                                $time->start_time = date("g:i a", strtotime($time->start_time));
                                $time->end_time = date("g:i a", strtotime($time->end_time));
                            }

                    }else{
                        $item->timings='';
                    }
                }

                $total_row = $sponsored->count();
                
                if($total_row > 0){

                    foreach($sponsored as $row){
                        $output .= "
                        <div class='col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12'>
                            <div class='border-r p-3'>

                                <section class='variable-width slider pt-2  tab-slider'>";
                                    foreach($row->pic_path as $pics){
                                    $output .= "<div>
                                        <img src='images/entitybranch/".$pics->picture."'>
                                    </div>";
                                    }
                                $output .= "</section>
                                <h6 class='pt-2'><b>".$row->entitybranches->title."</b></h6>
                                <div class='btn-group btn-group-sm'>";
                                    foreach($row->tags_name as $tags){
                                    $output .= "<button type='button' class='btn btn-dark bs'>".$tags->name."</button>";
                                    }
                                $output .="</div>
                                <br>";
                                foreach($row->timings as $time){
                                $output .="<h6 class='pt-3'><i class='fas fa-star'></i> <b> 4.2</b> <span class='time'>Opens At ".$time->start_time." - RN : ".$row->check."</span> </h6>";
                                }
                            $output .="</div>
                        </div>
                        ";
                    }
                }
            }
          
            $sponsored = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($sponsored);
        }
    }


}
