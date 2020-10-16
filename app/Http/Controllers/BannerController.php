<?php

namespace App\Http\Controllers;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banner = Banner::orderBy('sort_order','ASC')->get();
        return view('banners.index', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $banner = Banner::all();
        return view('banners.create', compact('banner'));
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
            'description' => 'required', 
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $banner = new Banner();
        $banner->description = $request->description;
        $banner->status = $request->status;
        $banner->image = "null"; 
        $banner->save();
        $updatebanner = Banner::find($banner->id);
        $file = $request->image;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "banners/".$banner->id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
        $updatebanner->image = $filePath;
        $updatebanner->update();   
        return back()->with('success', 'Banner successfully saved');
        

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
        $banner = Banner::findOrFail($id);
        return view('banners.edit', compact('banner'));
    }

    public function sortBanners(Request $request)
    {
        $banners = Banner::all();

        foreach ($banners as $banner) {
            foreach ($request->order as $order) {
                if ($order['id'] == $banner->id) {
                    $banner->update(['sort_order' => $order['position']]);
                }
            }
        }
        
        return response('true', 200);
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
            'description' => 'required', 
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $banner = Banner::find($id);
        $banner->description = $request->description;
        $banner->status = $request->status;
        if($request->has('image'))
        {   
            Storage::disk('public')->deleteDirectory('banners/'. $id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "banners/".$id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $banner->image =  $filePath;
        }
        
        $banner->save();   
        return back()->with('success', 'Banner updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //{
        Storage::disk('public')->deleteDirectory('banners/'. $id);
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return back()->with('success', 'Banner deleted successfully');
    }
    
    public function disableBanner($id) {
        $error = false;
        try {
            $banner = Banner::findOrFail($id);
            $banner->status = false;
            $banner->save();
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

    public function enableBanner($id) {
        $error = false;
        try {
            $banner = Banner::findOrFail($id);
            $banner->status = true;
            $banner->save();
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

