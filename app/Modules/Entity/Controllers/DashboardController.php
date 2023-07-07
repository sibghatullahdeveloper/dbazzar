<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Http\Requests\Admin\MerchantRequest;
use App\Models\OrderItem;
use View;
use Carbon\Carbon;
use App\User;
use App\Model\Entities;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }
    public function index(){


        return view('Entity::dashboard.index');
    }



}
