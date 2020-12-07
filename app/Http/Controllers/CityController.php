<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::with('countries')->get();
        return view('city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        return view('city.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:cities,name', 
            'country' => 'required', 
            'shipping_charges' => 'required',

            
            
        ]);
        $city = new City();
        $city->name = $request->name;
        $city->country_id = $request->country;
        $city->shipping_charges = $request->shipping_charges;
        $city->status = true;
        $city->save();   
        return back()->with('success', 'City successfully saved');
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
        $country = Country::all();
        $city = City::with('countries')->findOrFail($id);
        return view('city.edit', compact('city','country'));
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
        $validatedData = $request->validate([
            'name' => 'required|unique:cities,name'.$id, 
            'country' => 'required', 
            'shipping_charges' => 'required',
            
        ]);
        $city =City::find($id);
        $city->name = $request->name;
        $city->country_id = $request->country;
        $city->shipping_charges = $request->shipping_charges;
        $city->status = true;
        $city->save();   
        return back()->with('success', 'City updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return back()->with('success', 'City deleted successfully');
    }

    public function deactivateCity($id) {
        $error = false;
        try {
            $city = City::findOrFail($id);
            $city->status = false;
            $city->save();
            return 'true';
        }
        catch(\Exception $e) {
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return $message;
        }

    }

    public function activateCity($id) {
        $error = false;
        try {
            $city = City::findOrFail($id);
            $city->status = true;
            $city->save();
            return 'true';
        }
        catch(\Exception $e) {
           $error = true;
           $message = $e->getMessage(); 
        }
        if($error) {
            return $message;
        }

    }
}
