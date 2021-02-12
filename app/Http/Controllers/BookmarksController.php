<?php

namespace App\Http\Controllers;
use App\Bookmark;
use App\Currency;
//use App\Business;
use App\User;
use Session;
use App\ProductPrice;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookmarksController extends Controller
{
    public function __construct()
    {
       $this->middleware('permission:bookmark-list|bookmark-create|bookmark-edit|bookmark-delete', ['only' => ['index','show']]);
        $this->middleware('permission:bookmark-create', ['only' => ['create','store']]);
        $this->middleware('permission:bookmark-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bookmark-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')){
        $bookmark = Bookmark::with('users','product_prices','bookmark_size')->get();   
        return view('bookmarks.index', compact('bookmark'));}
        else if(auth()->user()->hasRole('publisher')){
            $bookmark = Bookmark::with('users','product_prices','bookmark_size')->where('user_id',auth()->user()->id)->get(); 
            return view('bookmarks.index', compact('bookmark'));
    }
        }

    
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $user = User::role('publisher')->get();
        $size = Size::all();
        return view('bookmarks.create',compact('user','size'));
    
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
            'title' => 'required',
            'maker_name' => 'required',
            'arabic_maker_name' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
            'price' => 'required|numeric',
            // 'bookmark_id' => 'required|numeric|unique:bookmarks',  
            'size' => 'required',
            'quantity' => 'required|numeric',
            'type_of_bookmark'=>'required',
            'publisher' => 'required',
            'stock_status' => 'required',
            'featured'=>'required',
            'image'=> 'required|image|mimes:jpg,jpeg,png|dimensions:max_width=300,max_height=900',
            'status' => 'required'

            ]);
            $lastBookmark = Bookmark::orderBy('created_at', 'desc')->first();
            $bookmark = new Bookmark();
            $bookmark->title = $request->title;
            if($request->arabic_title = '') {
                $bookmark->arabic_title = $request->title;
            }
            else {
                $bookmark->arabic_title = $request->arabic_title;
            }
            $bookmark->maker_name = $request->maker_name;
            $bookmark->arabic_maker_name = $request->arabic_maker_name;
            $bookmark->description= $request->description;
            $bookmark->arabic_description= $request->arabic_description;
            if($lastBookmark) {
                $bookmark->bookmark_id = sprintf('HB%03d',10000 + $lastBookmark->id);
            }
            else {
                $bookmark->bookmark_id =  sprintf('HB%03d',10000 + 1);
            }
            $bookmark->size= $request->size;
            $bookmark->quantity =$request->quantity;
            $bookmark->type_of_bookmark= $request->type_of_bookmark;
            $bookmark->user_id = $request->publisher;
            $bookmark->stock_status = $request->stock_status;
            if($request->has('featured') && $request->featured == "1") {
                $featuredBookmarks = Bookmark::where('featured',1)->count();
                if($featuredBookmarks == 8) {
                    $bookmark->featured = 0; 
                    Session::flash('featured', 'Bookmark Cannot Be Featured You can only feature 8 bookmarks at a time!'); 
                }
                else {
                    $bookmark->featured = $request->featured;
                }
            }
            else {
                $bookmark->featured = $request->featured;
            }
            $bookmark->added_by = auth()->user()->id;
            $bookmark->status = $request->status;
            $bookmark->image = "null"; 
            $bookmark->save();
            $updatebookmark = Bookmark::find($bookmark->id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookmarks/".$bookmark->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updatebookmark->image = $filePath;
            $updatebookmark->update(); 
            for($i=1;$i<=Count(Currency::all());$i++){  
            $productPrice= new ProductPrice();
            $productPrice->product_id= $bookmark->id;
            $productPrice->product_type= 'bookmark';
            $productPrice->price =$request->price;
            $productPrice->currency_id= $i;
            $productPrice->save();   }         
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
        $bookmark = Bookmark::with('bookmarkAddedBy','bookmark_size')->findOrFail($id);
      
        return view('bookmarks.detail',compact('bookmark'));
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
        $bookmark = Bookmark::with('users','product_prices')->findOrFail($id);
        $user = User::role('publisher')->get();
        $size = Size::all();
        return view('bookmarks.edit', compact('bookmark','user','size'));
       
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
            'arabic_maker_name' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
            'price' => 'required|numeric',
            // 'bookmark_id' => 'required|numeric|unique:bookmarks,bookmark_id,'.$id,  
            'size' => 'required',
            'quantity' => 'required|numeric',
            'type_of_bookmark'=>'required',
            'publisher' => 'required',
            'image'=> 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:max_width=300,max_height=900',
            'stock_status' => 'required',
            'featured'=>'required',
             'status' => 'required'
        
            ]);
        $bookmark = Bookmark::find($id);
        $bookmark->title = $request->title;
        if( $request->arabic_title == "") {
            $bookmark->arabic_title = $request->title;
        }
        else {
            $bookmark->arabic_title = $request->arabic_title;
        }
        $bookmark->maker_name = $request->maker_name;
        $bookmark->arabic_maker_name = $request->arabic_maker_name;
        $bookmark->description= $request->description;
        $bookmark->arabic_description= $request->arabic_description;
        $bookmark->size= $request->size;
        $bookmark->quantity =$request->quantity;
        $bookmark->type_of_bookmark= $request->type_of_bookmark;
        $bookmark->user_id = $request->publisher;
        $bookmark->stock_status = $request->stock_status;
        if ($request->has('featured') && $request->featured == "1") {
            $featuredBookmarks = Bookmark::where('featured',1)->count();
            if($featuredBookmarks == 8) {
                $bookmark->featured = 0; 
                Session::flash('featured', 'Bookmark Cannot Be Featured You can only feature 8 bookmarks at a time!'); 
            }
            else {
                $bookmark->featured = $request->featured;
            }
        }
        else {
            $bookmark->featured = $request->featured;
        }
        $bookmark->status = $request->status;
        if($request->has('image')) 
        {
            Storage::disk('public')->deleteDirectory('bookmarks/'. $id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookmarks/".$id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $bookmark->image =  $filePath;
        }
        $bookmark->save();  
        if($request->has('price'))
        {
            $productPrice= ProductPrice::where('product_id',$id)->where('product_type','bookmark')->first();
            //$productPrice->product_type= 'bookmark';
            $productPrice->price =$request->price;
            $productPrice->currency_id= 1;
            $productPrice->update();
        } 
        return back()->with('success', 'Bookmark update Sucessfully ');
       
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

    public function deactivateBookmark($id) {
        $error = false;
        try {
            $bookmark = Bookmark::findOrFail($id);
            $bookmark->status = false;
            $bookmark->save();
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

    public function activateBookmark($id) {
        $error = false;
        try {
            $bookmark = Bookmark::findOrFail($id);
            $bookmark->status = true;
            $bookmark->save();
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

        public function notfeatureBookmark($id) {
            $error = false;
            try {
                $bookmark = Bookmark::findOrFail($id);
                $bookmark->featured = false;
                $bookmark->save();
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
    
        public function featureBookmark($id) {
            $error = false;
            try {
                $featuredBookmarks = Bookmark::where('featured',1)->count();
                if($featuredBookmarks == 8 ) {
                    return 'false';
                }
                else {
                    $bookmark = Bookmark::findOrFail($id);
                    $bookmark->featured = true;
                    $bookmark->save();
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
    }

    
