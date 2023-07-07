<?php

namespace App\Modules\Affiliate\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Carbon\Carbon;
use App\User;
use App\Services\EntitiesService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ForgotPasswordToken;
use App\Model\AffiliateLedger;
use DB;

class LedgerController extends Controller
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

        return view('Affiliate::entitieslist.index');
    }

    public function ledgerView(){

        $affiliate_id = \Auth::guard('affiliate')->user()->affiliate_id;

        $LedgerDetails = AffiliateLedger::whereDate('created_at', date("Y-m-d"))->where('type','CREDIT')->where('affiliate_id',$affiliate_id)->get();

        $totalcredit = 0.0;

        if($LedgerDetails != ''){
            foreach ($LedgerDetails as $list) {
                $totalcredit += (float)$list->amount;
            }
        }

        return view('Affiliate::ledger.index')->with('list', $LedgerDetails)->with('totalcredit', $totalcredit);
    }

    public function LedgerDetails(Request $request){


        if($request->ajax()){
            
            $output = '';
            $totalcredit = 0.0;
            $date = Carbon::parse($request->get('date'))->format('yy-m-d');
            
            if($date != ''){

                $affiliate_id = \Auth::guard('affiliate')->user()->affiliate_id;

                $LedgerDetails = AffiliateLedger::whereDate('created_at', $date)->where('type','CREDIT')->where('affiliate_id',$affiliate_id)->get();
               //  dd($LedgerDetails);
                foreach ($LedgerDetails as $list) {

                    $output .= "
                        <tr>
                            <td>".$list->id."</td>
                            <td>".$list->transaction_no."</td>
                            <td>".$list->type."</td>
                            <td>".$list->amount."</td>
                            <td>".$list->created_at."</td>
                        <tr>
                    ";

                    $totalcredit += (float)$list->amount;
                }
            }
        }
        $dataArr = array(
                'table_data'  => $output,
                'total_amount'  => $totalcredit
            );

        echo json_encode($dataArr);
    }

   

}
