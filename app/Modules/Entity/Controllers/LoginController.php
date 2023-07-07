<?php

namespace App\Modules\Entity\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\Entities;
use App\User;
use App\Models\ForgotPasswordToken;

use App\Services\EmailService;

class LoginController extends Controller
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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/entity';
    protected $email_service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmailService $email_service)
    {
        $this->middleware('entity.guest')->except('signout');
        $this->email_service = $email_service;
    }

    public function showSigninForm(){
        return view('Entity::auth.signin');
    }

    public function signin(Request $request){
        //dd($request->);
        $this->validateLogin($request);

        //if ($this->hasTooManyLoginAttempts($request)) {
           // $this->fireLockoutEvent($request);

          //  return $this->sendLockoutResponse($request);
        //}
     //dd(md5($request->password) , $request->email);
        $userObj = User::whereEmail($request->email)
                    ->where('password' , md5($request->password))
                    ->where("email_verified","=",1)
                    ->whereRaw(" ( user_type = 'ENTITYADMIN' OR user_type = 'ENTITYUSER' ) ")
                    ->first();

      // dd($userObj);
        if ( empty($userObj)  ) {
            // $this->incrementLoginAttempts($request);
            return redirect(route("entity.signin"))->with('error', 'invalid email/password provided.');
        }


        $inputData = $request->all();

        $remember = 0;
        // if(empty($inputData['remember'])){
        //     $remember = 1;
        // }

       // $this->clearLoginAttempts($request);
        \Auth::guard('entity')->login($userObj, $remember);

        return redirect(route('entity.dashboard'));
    }

    public function showForgotPasswordForm(){
        return view('Entity::auth.forgot_password');
    }

    public function forgot_password(Request $request){

        $inputData = $request->all();

        $validationArr = [
            'email' => 'required|email|max:255',
        ];

        $validator = Validator::make($inputData, $validationArr);
        $email = $request->email;

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors())->withInput($inputData);
        }
        //dd($inputData);
        $userObj = User::where('email',$email)
                        ->whereRaw(" ( user_type = 'ADMIN' OR user_type = 'SUB_ADMIN' ) ")
                        ->where('user_status',1)
                        ->first();

        if(empty($userObj)){
            $error = trans('messages.customer.error.userEmailNotAvailable');
            return redirect(route("admin.forgot_password"))->with('error', $error);
        }

        $ip_address = $_SERVER['REMOTE_ADDR'];

        $forgot_password_token = new ForgotPasswordToken();
        $forgot_password_token->user_id = $userObj->id;
        $forgot_password_token->ip_address = $ip_address;
        $forgot_password_token->token = Str::random(40);
        $forgot_password_token->status = 0;
        $forgot_password_token->created_date = date('Y-m-d h:i:s');

        $forgot_password_token->save();

        $url = url('/admin/reset_password').'/'.$forgot_password_token->token;

        $msg = $this->email_service->forgotpassword($userObj->first_name,$userObj->last_name,$userObj->email,$url);

        $message = trans('messages.customer.success.forgotPasswordEmail');

        return redirect(route('admin.signin'))->with('success', $message);

    }

    public function showResetPasswordForm($token=""){

        $forgot_password_token = ForgotPasswordToken::where('token',$token)->where('status',0)->first();
        if(empty($forgot_password_token)){
            $error = trans('messages.customer.error.tokenInvalid');
            return redirect(route("admin.signin"))->with('error', $error);
        }

        $token_date = new \DateTime($forgot_password_token->created_date);
        $token_date->add(new \DateInterval('PT' . 30 . 'M'));
        $token_expiry_date = $token_date->format('Y-m-d h:i:s');
        $current_date = date('Y-m-d h:i:s');

        if($token_expiry_date <= $current_date){
            $error = trans('messages.customer.error.tokenExpired');
            return redirect(route("admin.signin"))->with('error', $error);
        }

        return view('Admin::auth.reset_password',compact('token'));
    }

    public function reset_password(Request $request){

        $inputData = $request->all();
        //dd($inputData);
        $validationArr = [
            'password' => 'required|string|min:6|max:150',
            'password_confirm' => 'required|string|max:150|same:password',
        ];

        $validator = Validator::make($inputData, $validationArr);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors())->withInput($inputData);
        }

        $forgot_password_token = ForgotPasswordToken::where('token',$inputData['token'])->first();

        $user = User::findOrFail($forgot_password_token->user_id);
        $user->password = md5($inputData['password']);
        $user->save();

        $forgot_password_token->status = 1;
        $forgot_password_token->updated_date = date('Y-m-d h:i:s');

        $forgot_password_token->save();

        $message = trans('messages.customer.success.resetPasswordchanged');

        return redirect(route('admin.signin'))->with('success', $message);

    }

    public function signout(){
        \Auth::guard('admin')->logout();
        return redirect(route('admin.signin'));
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'token' => 'required|string',
        ]);
    }

    protected function validateLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
    }


}
