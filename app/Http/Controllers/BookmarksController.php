<?php

namespace App\Http\Controllers;
use App\Bookmark;
use App\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookmark = Bookmark::with('businesses')->get();
        return view('bookmarks.index', compact('bookmark'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $business = Business::all();
        return view('bookmarks.create',compact('business'));
    
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
            'title' => 'required',
            'maker_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'bookmark_id' => 'required|numeric|unique:bookmarks',  
            'size' => 'required|numeric',
            'quantity' => 'required|numeric',
            'business_id' => 'required',
            'stock_status' => 'required',
            'image_url'=> 'required|image|mimes:jpg,jpeg,png|max:2048', 
            ]);
            $bookmark = new Bookmark();
            $bookmark->title = $request->title;
            $bookmark->maker_name = $request->maker_name;
            $bookmark->description= $request->description;
            $bookmark->price =$request->price;
            $bookmark->bookmark_id = $request->bookmark_id;
            $bookmark->size= $request->size;
            $bookmark->quantity =$request->quantity;
            $bookmark->business_id = $request->business_id;
            $bookmark->stock_status = $request->stock_status;
            $bookmark->image_url = "null"; 
            $bookmark->save();
            $updatebookmark = Bookmark::find($bookmark->id);
            $file = $request->image_url;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookmarks/".$bookmark->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updatebookmark->image_url = $filePath;
            $updatebookmark->update();   
            return back()->with('success', 'Bookmark successfully saved');
       
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
        $bookmark = Bookmark::findOrFail($id);
        $business = Business::all();
        return view('bookmarks.edit', compact('bookmark','business'));
       
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
            'title' => 'required',
            'maker_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'bookmark_id' => 'required|numeric|unique:bookmarks,bookmark_id,'.$id,  
            'size' => 'required|numeric',
            'quantity' => 'required|numeric',
            'business_id' => 'required|numeric',
            'image_url'=> 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048', 
            'stock_status' => 'required',
            ]);
        $bookmark = Bookmark::find($id);
        $bookmark->title = $request->title;
        $bookmark->maker_name = $request->maker_name;
        $bookmark->description= $request->description;
        $bookmark->price =$request->price;
        $bookmark->bookmark_id = $request->bookmark_id;
        $bookmark->size= $request->size;
        $bookmark->quantity =$request->quantity;
        $bookmark->business_id = $request->business_id;
        $bookmark->stock_status = $request->stock_status;
        if($request->has('image_url')) 
        {
            Storage::disk('public')->deleteDirectory('bookmarks/'. $id);
            $file = $request->image_url;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookmarks/".$id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $bookmark->image_url =  $filePath;
        }
        $bookmark->save();   
        return back()->with('success', 'Bookmark update sucessfully ');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::disk('public')->deleteDirectory('bookmarks/'. $id);
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();
        return back()->with('success', 'Bookmark deleted successfully');
    }
}
