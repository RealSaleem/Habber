<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteSetting;
use App\language;
class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
        $sitesetting = SiteSetting::with('languages')->get();
        return view('sitesetting.index', compact('sitesetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $language = Language::all();
        return view('sitesetting.create', compact('language'));
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
                    'email'=>'required',
                    'currency'=>'required|numeric',
                    'language'=>'required',
                    'phone_no'=>'required|numeric',
                    'whatsaap_number'=>'required|numeric',
                    'twitter_url'=>'required',
                    'facebook_url'=>'required',
                    'instagram_url'=>'required',
                    'snapchat_url'=>'required'
                ]);
                $sitesetting = new SiteSetting();
                $sitesetting->email=$request->email;
                $sitesetting->currency = $request->currency;
                $sitesetting->language=$request->language;
                $sitesetting->phone_no = $request->phone_no;
                $sitesetting->whatsaap_number=$request->whatsaap_number;
                $sitesetting->twitter_url = $request->twitter_url;
                $sitesetting->facebook_url = $request->facebook_url;
                $sitesetting->instagram_url = $request->instagram_url;
                $sitesetting->snapchat_url = $request->snapchat_url;
                $sitesetting->save();   
                return back()->with('success', 'setting successfully saved');       
         
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
        $sitesetting = SiteSetting::findOrFail($id);
        $language = Language::all();
        return view('sitesetting.edit', compact('sitesetting','language'));
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
            'email'=>'required',
            'currency'=>'required|numeric',
            'language'=>'required',
            'phone_no'=>'required|numeric',
            'whatsaap_number'=>'required|numeric',
            'twitter_url'=>'required',
            'facebook_url'=>'required',
            'instagram_url'=>'required',
            'snapchat_url'=>'required'
        ]);
        $sitesetting = SiteSetting::find($id);
        $sitesetting->email=$request->email;
        $sitesetting->currency = $request->currency;
        $sitesetting->language=$request->language;
        $sitesetting->phone_no = $request->phone_no;
        $sitesetting->whatsaap_number=$request->whatsaap_number;
        $sitesetting->twitter_url = $request->twitter_url;
        $sitesetting->facebook_url = $request->facebook_url;
        $sitesetting->instagram_url = $request->instagram_url;
        $sitesetting->snapchat_url = $request->snapchat_url;
        $sitesetting->save();   
        return back()->with('success', 'setting updated successfully ');       
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
        $sitesetting  = SiteSetting::findOrFail($id);
        $sitesetting->delete();
        return back()->with('success', 'Sitesetting deleted successfully');
    }
}
