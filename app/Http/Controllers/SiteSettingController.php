<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteSetting;
use App\Language;
use App\Currency;
use App;
use Session;
class SiteSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:site-setting-list|site-setting-create|site-setting-edit|site-setting-delete', ['only' => ['index','show']]);
        $this->middleware('permission:site-setting-create', ['only' => ['create','store']]);
        $this->middleware('permission:site-setting-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:site-setting-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
        $sitesetting = SiteSetting::with('languages','currencies')->get();
        return view('sitesetting.index', compact('sitesetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        $currency = Currency::all();
        return view('sitesetting.create', compact('language','currency'));
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
                    'currency'=>'required',
                    'language'=>'required',
                    'phone_no'=>'required',
                    'whatsaap_number'=>'required',
                    'twitter_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                    'facebook_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                    'instagram_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                    'snapchat_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
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
        $currency = Currency::all();
        return view('sitesetting.edit', compact('sitesetting','language','currency'));
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
            'currency'=>'required',
            'language'=>'required',
            'phone_no'=>'required',
            'whatsaap_number'=>'required',
            'twitter_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'facebook_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'instagram_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'snapchat_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ]);
        $sitesetting = SiteSetting::find($id);
        $sitesetting->email=$request->email;
        $sitesetting->currency = $request->currency;
        $sitesetting->language= $request->language;
        $sitesetting->phone_no = $request->phone_no;
        $sitesetting->whatsaap_number=$request->whatsaap_number;
        $sitesetting->twitter_url = $request->twitter_url;
        $sitesetting->facebook_url = $request->facebook_url;
        $sitesetting->instagram_url = $request->instagram_url;
        $sitesetting->snapchat_url = $request->snapchat_url;
        $sitesetting->save(); 
        $locale = "";  
        if($sitesetting->language == "1" ) 
        {
            $locale = "ar";
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        else {
            $locale = "en";
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        
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

    public  function setLanguage($locale) 
    {
        // dd($locale);
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
