<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Api\RegisterRepository;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Helpers\ApiHelper;
use App\User;
use App\ContactUs;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ContactUsRequest;
use App\Http\Requests\Api\JoinUsRequest;
use App\Http\Requests\Api\ForgetPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Events\ForgotPasswordApiEvent;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;
    protected $model;

    public function __construct(User $model) {
        $this->model = new RegisterRepository($model);
    }
    public function login() {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
            ])) 
        {
            $user = Auth::user();
           
            if($user->status == true && $user->joining_request == false) {
                $ftoken = User::where('email',request('email'))->first();
                $user['token'] = $user->createToken('token')->accessToken;
               
               $user['firebase_token'] = $this->firebaseTokenConvert(request('firebase_token'));
               $ftoken->firebase_token = $user['firebase_token'];
               $ftoken->save();
                return (new AuthResource($user->load('languages')));
            }
            else {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'User Not Activated');
                
            }
           
           
        } 
        else {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Incorrect Email or password');
        }
    }

    public function register(RegisterRequest $request) 
    { 
        try {
            $user = $this->model->create($request->all());
            return (new AuthResource($user->load('languages')))->additional(['message' => 'User Registered Successfullly']);
        }
        catch (\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
    public function sendEmail(Request $request){
        
        $user=User::where('email',$request['email'])->first();
       
       $token=app('auth.password.broker')->createToken($user);
        if($user==null){
           return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Email Not Found!');
        }
        $user=User::where('email',$request['email'])->first();
        $user->remember_token=$token;
        $user->update();
        event(new ForgotPasswordApiEvent($request,$token));
       return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Email Sent Successfully!');
       
        }
        public function updatePassword(Request $request) {
        
            $user=User::where('email',$request['email'])->first();
            if($user['remember_token'] == $request['remember_token']){
            try{
                $user1 = $this->model->updatePassword($request->all());
                if($user == true) {

                    return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,'Password Updated Successfully!');
                }
            }
            catch(\Exception $e) {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
            }}
            else{
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Sorry! The token is invalid!');
            }
        }
       
    public function forgotPassword(ForgetPasswordRequest $request) 
    {

        $response = $this->broker()->sendResetLink(
			$request->only('email')
		);

		return $response == Password::RESET_LINK_SENT
			? ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Reset link sent to your email.')
			: ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Unable to send reset link');
    }

    public function ContactUs(ContactUsRequest $request) {
        try{
            $contactUs = ContactUs::create($request->all());
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Message Submitted Successfully');
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }

    public function createJoinUsRequest(JoinUsRequest $request) {
        try{
            $joinUs = $this->model->createJoinRequest($request->all());
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Request Submitted Successfully');
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
    
    private function firebaseTokenConvert($token) {
        if (strlen($token) > 0 && strlen($token) < 70) {
            $apiKey = env('FIREBASE_API_KEY');
            $url = env('GOOGLE_API_APNS');
            $build = env('BUILD_NAME');
            $sandbox = env('FIREBASE_SANDBOX');
            $response = Http::withToken($apiKey)->post($url, [
                'apns_tokens' => [$token],
                'application' => $build,
                'sandbox' => $sandbox
            ]);
            $responseArray = json_decode($response,true);
            if ($responseArray['results'][0]['status'] == 'OK') {
                return $responseArray['results'][0]['registration_token'];
            } 
        }
        return $token;
    }
}
