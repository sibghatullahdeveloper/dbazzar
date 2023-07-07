<?php

namespace App\Modules\Affiliate\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\AffiliateLedger;
use App\Models\Order;
use App\Models\OrderItem;
use View;
use Carbon\Carbon;
use App\User;

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

        $affiliate_id = \Auth::guard('affiliate')->user()->affiliate_id;

        $totalcredit = AffiliateLedger::where('type','CREDIT')->where('affiliate_id',$affiliate_id)->get()->sum('amount');
        $totaldebit = AffiliateLedger::where('type','DEBIT')->where('affiliate_id',$affiliate_id)->get()->sum('amount');
        
       
        return view('Affiliate::dashboard.index',compact('totalcredit','totaldebit'));
    }

   

}
