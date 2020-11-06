<?php

namespace App\Http\Controllers;
use App\Ad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ad-list|ad-create|ad-edit|ad-delete', ['only' => ['index','show']]);
        $this->middleware('permission:ad-create', ['only' => ['create','store']]);
        $this->middleware('permission:ad-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ad-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad = Ad::all();
        return view('ads.index', compact('ad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'featured' => 'required'     
        ]);
        $ad = new Ad();
        $ad->featured = $request->featured;
        $ad->image = "null"; 
        $ad->save();
        $updateAd = Ad::find($ad->id);
        $file = $request->image;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "ads/".$ad->id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
        $updateAd->image = $filePath;
        $updateAd->update();   
        return back()->with('success', 'Ad successfully saved');
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
        $ad = Ad::findOrFail($id);
        return view('ads.edit', compact('ad'));
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
             'featured' => 'required',
            'image' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $ad = Ad::find($id);
        $ad->featured = $request->featured;
        if($request->has('image'))
        {   
            Storage::disk('public')->deleteDirectory('ads/'. $id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "ads/".$id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $ad->image =  $filePath;
        }
        
        $ad->save();   
        return back()->with('success', 'Ad updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::disk('public')->deleteDirectory('ads/'. $id);
        $ad = Ad::findOrFail($id);
        $ad->delete();
        return back()->with('success', 'Ad deleted successfully');
    }
}
