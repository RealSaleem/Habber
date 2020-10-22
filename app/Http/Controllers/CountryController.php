<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $country = Country::all();
        return view('countries.index', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $country = Country::all();
        return view('countries.create', compact('country'));
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
            'iso' => 'required|unique:countries,iso', 
            'name' => 'required|unique:countries,name', 
            'nicename' => 'required|unique:countries,nicename', 
            'iso3' => 'required|unique:countries,iso3', 
            'numcode' => 'required|unique:countries,numcode', 
            'phonecode' => 'required|unique:countries,phonecode', 

            
            
        ]);
        $country = new Country();
        $country->iso = $request->iso;
        $country->name = $request->name;
        $country->nicename = $request->nicename;
        $country->iso3 = $request->iso3;
        $country->numcode = $request->numcode;
        $country->phonecode = $request->phonecode;
        $country->save();   
        return back()->with('success', 'Country successfully saved');
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
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
       
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
            'iso' => 'required|unique:countries,iso,'.$id ,
            'name' => 'required|unique:countries,name,'.$id  ,
            'nicename' => 'required|unique:countries,nicename,'.$id  ,
            'iso3' => 'required|unique:countries,iso3,'.$id  ,
            'numcode' => 'required|unique:countries,numcode,'.$id ,
            'phonecode' => 'required|unique:countries,phonecode,'.$id  
            
        ]);
        $country =Country::find($id);
        $country->iso = $request->iso;
        $country->name = $request->name;
        $country->nicename = $request->nicename;
        $country->iso3 = $request->iso3;
        $country->numcode = $request->numcode;
        $country->phonecode = $request->phonecode;
        $country->save();   
        return back()->with('success', 'Country updated successfully ');
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
        $country = Country::findOrFail($id);
        $country->delete();
        return back()->with('success', 'Country deleted successfully');
    }
}
