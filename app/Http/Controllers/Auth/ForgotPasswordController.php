<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ForgotPasswordEvent;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;
 public function sendEmail(Request $request){
 
 $user=User::where('email',$request['email'])->first();
 if($user==null){
    return back()->with('error', 'Email Not Found!');
 }
 event(new ForgotPasswordEvent($request));
return back()->with('success', 'Email Sent Successfully!');

 }


}
