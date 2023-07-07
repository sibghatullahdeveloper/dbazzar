<?php

namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Settings;
use App\Services\SponsoredService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\SettingService;
use App\Services\EntitiesService;


class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected  $SettingService;
    protected  $EntitiesService;
    public function __construct(SettingService $SettingService ,EntitiesService  $EntitiesService)
    {
        $this->SettingService = $SettingService;
        $this->EntitiesService = $EntitiesService;
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $check=Settings::all();
        if(count($check)>0) {
            $settings=$this->SettingService->GetSettings();
            return view('Admin::Setting.view_form',compact('settings',$settings));

        }else
        {
            return view('Admin::Setting.view_form');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate([
            'status' =>'required',
        ]);


        $result=$this->SettingService->SaveSetting($request->all());
        return redirect()->back()->with('success', $result);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function settings_edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function settings_delete($id)
    {

    }

}

?>
