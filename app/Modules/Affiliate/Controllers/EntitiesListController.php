<?php

namespace App\Modules\Affiliate\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Carbon\Carbon;
use App\User;
use App\Services\EntitiesService;

class EntitiesListController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $EntitiesService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntitiesService $EntitiesService) {
         $this->EntitiesService = $EntitiesService;
    }
    public function index(){

       $lists = $this->EntitiesService->getAllEntitiesofAffiliate();
        return view('Affiliate::entitieslist.index',compact ('lists'));
    }

   

}
