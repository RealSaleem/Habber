<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Repositories\Api\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Helpers\ApiHelper;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Auth;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $model) {
        $this->model = new UserRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        try{
            $user = $this->model->update($request->all(),auth()->user()->id);
            return (new UserResource($user));
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }

    public function updatePassword(ChangePasswordRequest $request) {
        try{
            $user = $this->model->passwordUpdate($request->all());
            if($user == true) {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,'Password Updated Successfully!');
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }

    

    public function fcm(Request $request,$id){
        $user = User::find($id);
        $user->notification=$request->notification;
        $user->save();
       return (new UserResource($user))->additional(['message' => 'Changed Notification Permission Successfullly']);
   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function profile() {
        
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            if($user) {
                return (new UserResource($user));
            }
            else {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'User Not Activated');
                
            }
    }
}
