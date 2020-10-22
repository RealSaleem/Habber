<?php

namespace App\Http\Controllers;
use App\Business;
use App\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $business = Business::with('users')->get();
        return view('business.index', compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::where('id', '!=', 1)->get();
        return view('business.create',compact('user'));
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
        $validatedData = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'business_type' => 'required',
            'product_type' => 'required',
            'details' => 'required',  
             
        ]);
        $business = new Business();
        $business->user_id = $request->user_id;
        $business->name = $request->name;
        $business->business_type= $request->business_type;
        $business->product_type= $request->product_type;
        $business->details = $request->details; 
        $business->save();   
       return back()->with('success', 'Business successfully saved');
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
        $business = Business::findOrFail($id);
        $user = User::where('id', '!=', 1)->get();
        return view('business.edit', compact('business','user'));
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
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'name' => 'required',
            'business_type' => 'required',
            'product_type' => 'required',
            'details' => 'required',  
             
        ]);
        $business = Business::find($id);
        $business->user_id = $request->user_id;
        $business->name = $request->name;
        $business->business_type= $request->business_type;
        $business->product_type= $request->product_type;
        $business->details = $request->details; 
        $business->save();   
        return back()->with('success', 'Business update successfully ');
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
        $business = Business::findOrFail($id);
        $business->delete();
        return back()->with('success', 'Business deleted successfully');
    
    }
}
