<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Api\RegisterRepository;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Helpers\ApiHelper;
use App\User;
use App\ContactUs;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ContactUsRequest;
use App\Http\Requests\Api\JoinUsRequest;
use App\Http\Requests\Api\ForgetPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

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
            if($user->status == true) {
                $success['token'] = $user->createToken('token')->accessToken;
                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['email'] = $user->email;
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'You are logged in',$success);
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
            return (new UserResource($user))->additional(['message' => 'User Registered Successfullly']);
        }
        catch (\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
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
}
