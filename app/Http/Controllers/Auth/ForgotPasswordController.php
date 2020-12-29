<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ForgotPasswordEvent;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use App\Repositories\Api\RegisterRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\ChangePasswordRequest;


class ForgotPasswordController extends Controller
{
    protected $model;

    public function __construct(User $model) {
        $this->model = new RegisterRepository($model);
    }

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
       $token=app('auth.password.broker')->createToken($user);
        if($user==null){
            return back()->with('error', 'Email Not Found!');        }
        $user=User::where('email',$request['email'])->first();
        $user->remember_token=$token;
        $user->update();
        event(new ForgotPasswordEvent($request,$token));
        return back()->with('success', 'Email Sent Successfully!');

}

public function updatePassword(ChangePasswordRequest $request) {
        
    $user=User::where('email',$request['email'])->first();
    if($user['remember_token']==$request['remember_token']){
    try{
        $user1 = $this->model->updatePassword($request->all());
        if($user == true) {
            return back()->with('success', 'Password Updated Successfully!');
           // return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,'Password Updated Successfully!');
        }
    }
    catch(\Exception $e) {
        return back()->with('error', $e->getMessage());
      //  return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
    }}
    else{
        return back()->with('error', 'Sorry! The token is invalid!');
        //return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Sorry! The token is invalid!');
    }
}

}