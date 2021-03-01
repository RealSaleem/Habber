<?php

namespace App\Http\Controllers;
use App\Banner;
use App\Book;
use App\Bookmark;
use App\BookClub;
use App\Language;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    public function __construct()
 {
        $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => ['index','show']]);
        $this->middleware('permission:banner-create', ['only' => ['create','store']]);
     $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:banner-delete', ['only' => ['destroy']]);
   }
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
            'banner_url'=>'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'bookmarks_id'=>'sometimes|required',
            'bookclubs_id'=>'sometimes|required',
            'books_id'=>'sometimes|required',
            'status' => 'required',
            'sort_order' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|dimensions:max_width=1000,max_height=450',
             
         ]);
        $banner = new Banner();
        $banner->product_type = $request->product_type;
        $banner->banner_url = $request->banner_url;
        if ($request->has('status') && $request->status == "1") {
            $statusBanners = Banner::where('status',1)->count();
            if(  $statusBanners == 3) {
                $banner->status = 0; 
                Session::flash('status', 'Banners Cannot Be Enabled You can only Enable 3 banners at a time!'); 
            }
            else {
                $banner->status = $request->status;
            }
        }
        else {
            $banner->status = $request->status;
        }
        $banner->sort_order = $request->sort_order;
        $banner->image = "null"; 
        if($request->has('description'))
        {   
            $banner->description = $request->description;
        }
        if($request->has('bookmark_id'))
        {   
            $banner->bookmark_id =  $request->bookmark_id;
        }
        if($request->has('bookclub_id'))
        {   
            $banner->bookclub_id =  $request->bookclub_id;
        }
        if($request->has('book_id'))
        {   
            $banner->book_id =  $request->book_id;
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
        $banner = Banner::with('languages','books','bookmarks','bookclubs')->findOrFail($id);
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
            'banner_url'=> 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'status' => 'required',
            'sort_order'=>'required',
            'image' => 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:max_width=1000,max_height=450',
        ]);
        $banner = Banner::find($id);
        $banner->product_type = $request->product_type;
        $banner->banner_url = $request->banner_url;
        if($banner->status!=$request->status){
        if ($request->has('status') && $request->status == "1") {
            $statusBanners = Banner::where('status',1)->count();
            if(  $statusBanners == 3) {
                $banner->status = 0; 
                Session::flash('status', 'Banners Cannot Be Enabled You can only feature 3 banners at a time!'); 
            }
            else {
                $banner->status = $request->status;
            }
        }
        else {
            $banner->status = $request->status;
        }}
        $banner->sort_order = $request->sort_order;
        if($request->has('description'))
        {   
            $banner->description = $request->description;
        }
        if($request->has('bookmark_id'))
        {   
            $banner->bookmark_id =  $request->bookmark_id;
        }
        if($request->has('bookclub_id'))
        {   
            $banner->bookclub_id =  $request->bookclub_id;
        }
        if($request->has('book_id'))
        {   
            $banner->book_id =  $request->book_id;
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
            $statusBanners = Banner::where('status',1)->count();
            if($statusBanners == 3 ) {
                return 'false';
            }
            else {
                $banner = Banner::findOrFail($id);
                $banner->status = true;
                $banner->save();
                return 'true';
            }
           
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
        if($type == "book") {
            $response['id'] =  Book::pluck('id')->toArray();
            $response['name'] = Book::pluck('title')->toArray();
        }
        if($type == "bookmark") {
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
  



