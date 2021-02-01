<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use User;
use Auth;
use App\Http\Resources\AuthResource;



use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        //
        public function login1() {
            if (Auth::attempt([
                'email' => request('email'),
                'password' => request('password'),
                'status' => 1
                ])) 
            {
                $user = Auth::user();
               
                if($user->status == 0 && $user->joining_request == 0) {
                    $user['token'] = $user->createToken('token')->accessToken;
                   
                    return (new AuthResource($user->load('languages')));
                }
            }
            else  {
                return back()->with('success', 'Either Invalid Email/Password Or User not Active');
            }
        }
    
    
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
