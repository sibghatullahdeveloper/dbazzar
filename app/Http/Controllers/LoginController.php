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
use Socialite;

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
    protected $redirectTo = '/';
    protected $email_service;
    protected $CheckoutService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmailService $email_service,CheckoutService $CheckoutService)
    {
        $this->middleware('customer.guest')->except('signout' ,'saveVoucher');
        $this->email_service = $email_service;
         $this->CheckoutService = $CheckoutService;
    }

    public function saveVoucher($voucher,$user_id){
        
        $Evoucher = Evoucher::where('id',$voucher)->first();

        $save = new SavedVoucher();
        $data['user_id'] = $user_id;
        $data['voucher_id'] =$Evoucher->id;
        $data['entity_id'] =$Evoucher->entity_id;
        $data['status'] = 1;

        $save->create($data);
         //dd($save);
        $msg = "Voucher is saved in your account you can apply it on checkout !!";
        return redirect(route('Checkout'))->with('success', $msg);
    }
    public function showSignUpForm(){

        return view('auth.signup');
    }
    public function signup(Request $request){

        $this->validateSignup($request);

       $inputData = $request->all();
        $inputData['user_type'] = 'CUSTOMER';
        $inputData['email_verified'] = 0;
        $inputData['email_verified_token'] = Str::random(40);
        $inputData['password_changed'] = 0;

        $obj = new ConsumerUser();
        $obj->first_name = $inputData['first_name'];
        $obj->last_name = $inputData['last_name'];
        $obj->username = $inputData['username'];
        $obj->contact_number = $inputData['contact_number'];
        $obj->email = $inputData['email'];
        $obj->password = md5($inputData['password']);
        $obj->user_type = $inputData['user_type'];
        $obj->email_verified = $inputData['email_verified'];
        $obj->email_verified_token = $inputData['email_verified_token'];
        $obj->password_changed = $inputData['password_changed'];
        $obj->uuid = Str::uuid(40)->toString();

        $user = $obj->save();

         if(isset($_COOKIE["cookie_token"])){
                    $token=$_COOKIE['cookie_token'];

                 $res =   $this->CheckoutService->MakeUserCartFromCookies($token,$user->id);
              }

        $url = url('/confirm').'/'.$inputData['email_verified_token'];

        $msg = $this->email_service->signup($inputData['first_name'],$inputData['last_name'],$inputData['email'],$url);

        return redirect(route('signin'))->with('success', $msg);


    }

    public function confirm($token = ""){

        if(empty($token)){
            return redirect("signin")->with('error', 'Invalid Token !!');
        }

        $user = ConsumerUser::where("email_verified_token","=", $token)->where("user_type","=","CUSTOMER")->first();

        if(empty($user))
        {
            return redirect("signin")->with('error', 'User Does not exist !!');
        }
       // dd($user);
        $user->email_verified = "1";
        $user->email_verified_token = "";
        $user->save();
        $msg = 'Your Account is Activated!!';
        return redirect(route('signin'))->with('success',$msg);

    }

    public function showSigninForm(){
        return view('auth.signin');
    }
    public function signin(Request $request){
       // dd($request->all());
        $this->validateLogin($request);

        $userObj = ConsumerUser::whereEmail($request->email)
                ->where('password',md5($request->password))
                    ->where("email_verified","=",1)
                    ->whereRaw(" ( user_type = 'CUSTOMER' ) ")
                    ->first();




        if ( empty($userObj)  ) {
           // $this->incrementLoginAttempts($request);
            return redirect(route("createCheckout"))->with('error', 'invalid email/password provided.');
        }

        if(isset($_COOKIE["cookie_token"])){
                    $token=$_COOKIE['cookie_token'];

                 $res =   $this->CheckoutService->MakeUserCartFromCookies($token,$userObj->id);
              }
        $remember = 0;

        \Auth::guard('customer')->login($userObj, $remember);
        $cart = $this->CheckoutService->getCartByUser(\Auth::guard('customer')->user()->id);
        if($cart->isEmpty()){
             return redirect(route('myaccount'));
        }
       else
       {
        return redirect(route('Checkout'));
       }
    }


    public function showForgotPasswordForm(){
        return view('auth.forgot_password');
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
       // dd($email);
        $userObj = ConsumerUser::where('email',$email)
                        ->whereRaw(" ( user_type = 'CUSTOMER' ) ")
                        ->where('email_verified',1)
                        ->first();

        if(empty($userObj)){
            $error = 'User Email Not Available';
            return redirect(route("forgot_password"))->with('error', $error);
        }

        $ip_address = $_SERVER['REMOTE_ADDR'];

        $forgot_password_token = new ForgotPasswordToken();
        $forgot_password_token->user_id = $userObj->id;
        $forgot_password_token->ip_address = $ip_address;
        $forgot_password_token->token = Str::random(40);
        $forgot_password_token->status = 0;

        $forgot_password_token->save();

        $url = url('/reset_password').'/'.$forgot_password_token->token;

        $msg = $this->email_service->forgotpassword($userObj->first_name,$userObj->last_name,$userObj->email,$url);

        $message = 'Forget Password Token is sent to your Email ';

        return redirect(route('signin'))->with('success', $message);

    }

    public function showResetPasswordForm($token=""){

        $forgot_password_token = ForgotPasswordToken::where('token',$token)->where('status',0)->first();
        if(empty($forgot_password_token)){
            $error = 'Password token Invalid';
            return redirect(route("signin"))->with('error', $error);
        }

        $token_date = new \DateTime($forgot_password_token->created_at);
        $token_date->add(new \DateInterval('PT' . 30 . 'M'));
        $token_expiry_date = $token_date->format('Y-m-d h:i:s');
        $current_date = date('Y-m-d h:i:s');

        if($token_expiry_date <= $current_date){
            $error = trans('Password token Expired');
            return redirect(route("signin"))->with('error', $error);
        }

        return view('auth.reset_password',compact('token'));
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

        $user = ConsumerUser::findOrFail($forgot_password_token->user_id);
        $user->password = md5($inputData['password']);
        $user->save();

        $forgot_password_token->status = 1;
        $forgot_password_token->updated_at = date('Y-m-d h:i:s');

        $forgot_password_token->save();

        $message ='Password Changed Successfully';

        return redirect(route('createCheckout'))->with('success', $message);

    }

    public function signout(){
        \Auth::guard('customer')->logout();
        return redirect(route('signin'));
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

    protected function validateSignup(Request $request) {
        $this->validate($request, [
            'email'=>'required|string|email|regex:/^[a-z0-9@._ -]+$/|max:150|unique:consumer_users',
            'password' => 'required|string|max:150',
            'password_confirm' => 'required|string|max:150|same:password',
        ]);
    }


/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try
        {
            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
       // dd($user);
        if(!$socialProvider)
        {
            //create a new user and provider
            $name = explode(' ', $socialUser->getName());
            $first_name = $name[0];
            $last_name = $name[count($name) -1];
            $username = $first_name.'_'.$last_name;
            $user = ConsumerUser::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                ['first_name' => $first_name,'last_name' => $last_name,'username' => $username ,'uuid' => Str::uuid(40)->toString() ,
                'user_type' =>'CUSTOMER' ,'email_verified' => 1 , 'password' => '']
            );

            $user->socialProviders()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );

        }
        else
            $user = $socialProvider->user;

         if(isset($_COOKIE["cookie_token"])){
                    $token=$_COOKIE['cookie_token'];

                 $res =   $this->CheckoutService->MakeUserCartFromCookies($token,$user->id);
              }
        //dd($user);
         $remember = 0;

        \Auth::guard('customer')->login($user, $remember);


        $cart = $this->CheckoutService->getCartByUser(\Auth::guard('customer')->user()->id);
         if($cart->isEmpty()){
             return redirect(route('myaccount'));
        }
       else
       {
        return redirect(route('Checkout'));
       }

    }

}
