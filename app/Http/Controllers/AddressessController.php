<?php

namespace App\Http\Controllers;
use App\Address;
use App\User;
use Illuminate\Http\Request;

class AddressessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $address = Address::with('users')->get();
        return view('addressess.index', compact('address'));
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
        return view('addressess.create',compact('user'));
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
            'address_name' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country_id' => 'required',
            'post_code' => 'required|numeric',
            'phone' => 'required|numeric',   
            'user_id' => 'required',  
             
        ]);
        $address = new Address();
        $address->address_name = $request->address_name;
        $address->address_line1 = $request->address_line1;
        $address->address_line2= $request->address_line2;
        $address->city= $request->city;
        $address->state = $request->state; 
        $address->country_id = $request->country_id;
        $address->post_code= $request->post_code;
        $address->phone= $request->phone;
        $address->user_id = $request->user_id; 
        $address->save();   
       return back()->with('success', 'Adress successfully saved');
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
        $address = Address::findOrFail($id);
        $user = User::where('id', '!=', 1)->get();
        return view('addressess.edit', compact('address','user'));
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
            'address_name' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country_id' => 'required',
            'post_code' => 'required|numeric',
            'phone' => 'required|numeric',   
            'user_id' => 'required',  
             
        ]);
        $address = Address::find($id);
        $address->address_name = $request->address_name;
        $address->address_line1 = $request->address_line1;
        $address->address_line2= $request->address_line2;
        $address->city= $request->city;
        $address->state = $request->state; 
        $address->country_id = $request->country_id;
        $address->post_code= $request->post_code;
        $address->phone= $request->phone;
        $address->user_id = $request->user_id; 
        $address->save();   
       return back()->with('success', 'Address update successfully');
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
        $address = Address::findOrFail($id);
        $address->delete();
        return back()->with('success', 'Address deleted successfully');
    }
}
