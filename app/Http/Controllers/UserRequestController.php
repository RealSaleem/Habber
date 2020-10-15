<?php

namespace App\Http\Controllers;
use App\RequestForBook;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userRequest = RequestForBook::with('users')->get();
        return view('user_requests.index', compact('userRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $userrequest = RequestForBook::first();
       
       
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
        $userRequest = RequestForBook::with('users')->find($id);
        return view('user_requests.detail', compact('userRequest'));
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
        $error = false;
        try{
            $userRequest = RequestForBook::find($id);
            $userRequest->status = $request->status;
            $userRequest->update();
            return back()->with('success', 'Status Updated Successfully!');
        }
        catch(\Exception $e) {
           
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return back()->with('success', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error = false;
        try{
            Storage::disk('public')->deleteDirectory('user_requests/' .  $id);
            $userRequest = RequestForBook::find($id);
            $userRequest->delete();
            return back()->with('success', 'Request Deleted Successfully!');
        }
        catch(\Exception $e) {
           
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return back()->with('success', $message);
        }
    }
}
