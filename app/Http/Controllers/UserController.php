<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\ConsumerUser;
use App\Model\ForgotPasswordToken;
use App\Model\EmailTemplate;
use App\Services\EmailService;
use App\Services\CheckoutService;
use App\Model\SavedVoucher;
use App\Model\Evoucher;
use App\Model\SocialProvider;
use Carbon\Carbon;
use Socialite;

class UserController extends Controller{

	public function __construct() {

    }

    public function index(){

    	$user = \Auth::guard('customer')->user();
    	
    	return view('user_profile')->with('user',$user);
    }

    public function editProfile(Request $request){

    	$user = new ConsumerUser();
            
        if(isset($request['id'])){

        	$user->where('id',$request['id'])
                ->update([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'username' => $request['username'],
                    'contact_number' => $request['contact_number'],
                    'updated_at' =>Carbon::now()
            	]);
        }
    	
    	return redirect(route('myaccount'));

    }

    public function editPassword(Request $request){

    	$inputData = $request->all();
        $session_user = \Auth::guard('customer')->user();
        
        $validationArr = [
            'password' => 'required|string|min:6|max:150',
            'password_confirm' => 'required|string|max:150|same:password',
        ];

        $validator = Validator::make($inputData, $validationArr);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors())->withInput($inputData);
        }

        $user = new ConsumerUser();

        $user->where('id',$request['id'])
            ->update([
                'password' => md5($inputData['password']),
                'updated_at' =>Carbon::now()
            ]);
    	
    	return redirect(route('myaccount'));
    }

}