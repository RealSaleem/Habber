<?php

namespace App\Http\Controllers;
use App\User;
use App\Events\SendNotificationEvent;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Session;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersDropDown =   $user = User::role(['user','publisher'])->where('status',1)->where('joining_request',0)->get();
 return view('push_notifications.create', compact('usersDropDown'));
    }

        
        function sendNotification(Request $request){

            $validatedData = $request->validate([
                'users' => 'sometimes|required',    
                'title' => 'required',
                'option' => 'required',
                'description' => 'required' ]);
              
                $data = array(
                    'title' => $request->title,
                    'option' => $request->option,
                    'description' => $request->description, 
                    'users' => $request->users,
                    );

                   // event(new SendNotificationEvent($data));
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
    public function update(Request $request, $id)
    {
        //
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
}
