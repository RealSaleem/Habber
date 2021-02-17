<?php

namespace App\Http\Controllers;
use App\Address;
use App\User;
use App\Country;
use Illuminate\Http\Request;

class AddressController extends Controller
{

   public function __construct()
    {
        $this->middleware('permission:address-list|address-create|address-edit|address-delete', ['only' => ['index','show']]);
        $this->middleware('permission:address-create', ['only' => ['create','store']]);
        $this->middleware('permission:address-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:address-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::with('countries','cities')->get();
        return view('address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('id', '!=', 1)->get();
        $country = Country::orderBy('name','ASC')->get();
        return view('address.create',compact('user','country'));
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
        $address->city_id = $request->city;
        $address->state = $request->state; 
        $address->country_id = $request->country_id;
        $address->post_code= $request->post_code;
        $address->phone= $request->phone;
        $address->user_id = $request->user_id; 
        $address->save();   
       return back()->with('success', 'Address successfully saved');
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
        
        $address = Address::with('users','cities')->findOrFail($id);
        $user = User::all();
        $fromUser = request()->fromUser;
        $country = Country::all();
        return view('address.edit', compact('address','user','fromUser','country'));

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
             
        ]);
        $address = Address::find($id);
        $address->address_name = $request->address_name;
        $address->address_line1 = $request->address_line1;
        $address->address_line2= $request->address_line2;
        $address->city_id= $request->city;
        $address->state = $request->state; 
        $address->country_id = $request->country_id;
        $address->post_code= $request->post_code;
        $address->phone= $request->phone;
        $address->save();   
       return back()->with('success', 'Address update successfully');
    }

    public function getUserAddressList($id)
    {
        $address = Address::where('user_id',$id)->get();
        $fromUser = User::find($id);
        return view('address.index', compact('address','fromUser'));
    }

    public function createUserAddress($id)
    {
        $user = User::where('id',$id)->get();
        $fromUser = $id;
        $country = Country::all();
        return view('address.create',compact('user','fromUser','country'));
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
    $address->status=0;
    $address->update();
        return back()->with('success', 'Address deleted successfully');
    }
}
