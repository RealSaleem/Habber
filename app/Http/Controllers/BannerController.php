<?php

namespace App\Http\Controllers;
use App\Banner;
use App\Book;
use App\Bookmark;
use App\BookClub;
use App\Language;
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
        $banner = Banner::with('languages','books','bookmarks','bookclubs')->orderBy('sort_order','ASC')->get();
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
        $language = Language::all();
        return view('banners.create', compact('banner','language'));
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
            'product_type'=>'required',
            'language_id' => 'required',
            'bookmarks_id'=>'sometimes|required',
            'bookclubs_id'=>'sometimes|required',
            'books_id'=>'sometimes|required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|dimensions:width=1000,height=450|dimensions:ratio=2.25/1',
             
         ]);
        $banner = new Banner();
        $banner->product_type = $request->product_type;
        $banner->language_id = $request->language_id;
        $banner->status = $request->status;
        $banner->image = "null"; 
        if($request->has('description'))
        {   
            $banner->description = $request->description;
        }
        if($request->has('bookmarks_id'))
        {   
            $banner->bookmark_id =  $request->bookmarks_id;
        }
        if($request->has('bookclubs_id'))
        {   
            $banner->bookclub_id =  $request->bookclubs_id;
        }
        if($request->has('books_id'))
        {   
            $banner->book_id =  $request->books_id;
        }
        $banner->save();
        $updatebanner = Banner::find($banner->id);
        $file = $request->image;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "banners/".$banner->id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
        if(!Storage::disk('public')->has("banners/".$banner->id)) {
            Storage::disk('public')->makeDirectory("banners/".$banner->id);
        }
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
        $language = Language::all();
        return view('banners.edit', compact('banner','language'));
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
            'product_type'=> 'required',
            'bookmarks_id'=>'sometimes|required',
            'bookclubs_id'=>'sometimes|required',
            'books_id'=>'sometimes|required',
            'language_id' => 'required',
            'status' => 'required',
            'image' => 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:width=1000,height=450|dimensions:ratio=2.25/1',
        ]);
        $banner = Banner::find($id);
        $banner->product_type = $request->product_type;
        $banner->language_id = $request->language_id;
        $banner->status = $request->status;
        if($request->has('description'))
        {   
            $banner->description = $request->description;
        }
        if($request->has('bookmarks_id'))
        {   
            $banner->bookmark_id =  $request->bookmarks_id;
        }
        if($request->has('bookclubs_id'))
        {   
            $banner->bookclub_id =  $request->bookclubs_id;
        }
        if($request->has('books_id'))
        {   
            $banner->book_id =  $request->books_id;
        }
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

    public function getDropDownList($type)
    {
        $response;
        if($type == "books") {
            $response['id'] =  Book::pluck('id')->toArray();
            $response['name'] = Book::pluck('title')->toArray();
        }
        if($type == "bookmarks") {
            $response['id'] =  Bookmark::pluck('id')->toArray();
            $response['name'] = Bookmark::pluck('title')->toArray();
        }
        if($type == "bookclub") {
            $response['id'] =  BookClub::pluck('id')->toArray();
            $response['name'] = BookClub::pluck('name')->toArray();
        }
        return response()->json($response);
    }
   
}
  



