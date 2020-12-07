<?php

namespace App\Http\Controllers;
use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','show']]);
        $this->middleware('permission:country-create', ['only' => ['create','store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }
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
            'status' => 'required'

            
            
        ]);
        $country = new Country();
        $country->iso = $request->iso;
        $country->name = $request->name;
        $country->nicename = $request->nicename;
        $country->iso3 = $request->iso3;
        $country->numcode = $request->numcode;
        $country->phonecode = $request->phonecode;
        $country->status = $request->status;
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
            'phonecode' => 'required|unique:countries,phonecode,'.$id  ,
            'status'=> 'required',
            
        ]);
        $country =Country::find($id);
        $country->iso = $request->iso;
        $country->name = $request->name;
        $country->nicename = $request->nicename;
        $country->iso3 = $request->iso3;
        $country->numcode = $request->numcode;
        $country->phonecode = $request->phonecode;
        $country->status = $request->status;
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

    public function disableCountry($id) {
        $error = false;
        try {
            $country = Country::findOrFail($id);
            $country->status = false;
            $country->save();
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

    public function enableCountry($id) {
        $error = false;
        try {
            $country = Country::findOrFail($id);
            $country->status = true;
            $country->save();
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
