<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;
use App\Model\EmailTemplate;
use App\Mail\customRawtemplate;
use Log;

class EmailService
{

    public function signup($first_name, $last_name, $email, $url)
    {	
    	$template = EmailTemplate::where('email_type', 'customer-account-confirmation')->first();
        $message = str_replace( "[COMPLETE_NAME]", $first_name.' '.$last_name ,$template->message);
        $message = str_replace( "[CONFIRMATION_LINK]", $url ,$message );
        
        Mail::to( $email )->send(new customRawtemplate( $template->subject, $message ) );
        //Mail::to($user->email)->send(new merchantConfirmation($user));
        $msg = "Your Account Activation Email is Sent Please Confirm Your Email!";

        return $msg;
    }
    public function sendVoucherEmail($first_name, $last_name, $email,$ev_name,$ev_desc, $url){
        $voucher = $ev_name."<br>".$ev_desc;
        $template = EmailTemplate::where('email_type', 'customer-evoucher')->first();
        $message = str_replace( "[COMPLETE_NAME]", $first_name.' '.$last_name ,$template->message);
        $message = str_replace( "[CONFIRMATION_LINK]", $url ,$message );
        $message = str_replace("[EVOUCHER]", $voucher, $message);
        Mail::to( $email )->send(new customRawtemplate( $template->subject, $message ) );
        //Mail::to($user->email)->send(new merchantConfirmation($user));
        $msg = "Email Sent!";

        return $msg;


    }
    public function forgotpassword($first_name, $last_name, $email, $url)
    {	
    	
        $template = EmailTemplate::where('email_type', 'forgot-password-confirmation')->first();

        $message = str_replace( "[COMPLETE_NAME]", $first_name.' '.$last_name ,$template->message );
        $message = str_replace( "[CONFIRMATION_LINK]", $url ,$message );
        
        Mail::to( $email )->send(new customRawtemplate( $template->subject, $message ) );

        //$msg = trans('messages.customer.success.confirmationEmail');
        $msg = "Email Sent!";
        
        return $msg;

    }

    public function ContactUs($first_name,$last_name,$email,$mobile_number,$comments)
    {   

        $email_addresss = env("MAIL_FROM_ADDRESS", "somedefaultvalue"); 
        $template = EmailTemplate::where('email_type', 'contactus')->first();
    
        $message = str_replace( "[FIRST_NAME]",$first_name,$template->message_en );
        $message = str_replace( "[LAST_NAME]",$last_name,$message );
        $message = str_replace( "[EMAIL_ADDRESS]",$email,$message);
        $message = str_replace( "[MOBILE_NUMBER]",$mobile_number,$message);
        $message = str_replace( "[COMMENTS]",$comments,$message );
        Mail::to($email_addresss )->cc('customer@tourism.com')->send(new customRawtemplate( $template->subject_en, $message ) );

         $msg = trans('messages.customer.success.ContactCreate');;
          
        return $msg;

    }
     public function CommentsReplay($first_name,$last_name,$email,$replay)
    {   
        $template = EmailTemplate::where('email_type','contact-reply')->first();
        
        $message = str_replace( "[FIRST_NAME]",$first_name,$template->message_en );
        $message = str_replace( "[LAST_NAME]",$last_name,$message );
        $message = str_replace( "[EMAIL_ADDRESS]",$email,$message);
        $message = str_replace( "[REPLY]",$replay,$message);
        Mail::to($email)->cc('customer@tourism.com')->send(new customRawtemplate( $template->subject_en, $message ) );

        $msg = trans('messages.customer.success.ConactUsEmail');



        return $msg;

    }
    public function appforgotpassword($first_name, $last_name, $email, $otp)
    {   
        
        $template = EmailTemplate::where('email_type', 'app-forgot-password-confirmation')->first();

        $message = str_replace( "[COMPLETE_NAME]", $first_name.' '.$last_name ,$template->message_en );
        $message = str_replace( "[OTP]", $otp ,$message );
        
        Mail::to( $email )->send(new customRawtemplate( $template->subject_en, $message ) );

        $msg = trans('messages.guest.success.confirmationEmail');

        return $msg;

    }


}
