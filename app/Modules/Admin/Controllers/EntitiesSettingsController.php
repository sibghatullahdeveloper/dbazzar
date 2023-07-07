<?php

namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Services\SponsoredService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Services\EntitiesSettingService;
use App\Services\EntitiesService;
use App\Http\Requests\Admin\EntitySettingsRequest;

class EntitiesSettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected  $EntitiesSettingService;
    protected  $EntitiesService;
    public function __construct(EntitiesSettingService $EntitiesSettingService ,EntitiesService  $EntitiesService)
    {
        $this->EntitiesSettingService = $EntitiesSettingService;
        $this->EntitiesService = $EntitiesService;
    }
    public function index()
    {
        $EntitiesSetting_list= $this->EntitiesSettingService->EntitiesSettingList();

        return view('Admin::EntitiesSetting.index')->with('lists', $EntitiesSetting_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($uuid=null)
    {

        $items=$this->EntitiesService->getAllEntitiesIndex($uuid);


        return view('Admin::EntitiesSetting.view_form',compact('items',$items));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $validator = EntitySettingsRequest::validator($request->all())->validate();

        $result=$this->EntitiesSettingService->SaveEntitiesService($request->all());
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

    public function entity_settings_edit($id)
    {

        $EntitiesSettings=$this->EntitiesSettingService->EditEntitiesSettingService($id);

        return view('Admin::EntitiesSetting.view_form',compact('EntitiesSettings' ,$EntitiesSettings));
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
    public function entity_settings_delete($id)
    {
        $result=  $this->EntitiesSettingService->Delete_entity_settings_delete($id);
        return redirect()->back()->with('success', $result);
    }

}

?>
