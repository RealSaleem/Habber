<?php

namespace App\Http\Controllers;
use App\Bookmark;
//use App\Business;
use App\User;
use App\ProductPrice;
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
        $bookmark = Bookmark::with('users','product_prices')->get();
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
        $user = User::role('publisher')->get();
        return view('bookmarks.create',compact('user'));
    
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
            'arabic_title' => 'required',
            'maker_name' => 'required',
            'arabic_maker_name' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
            'price' => 'required|numeric',
            'bookmark_id' => 'required|numeric|unique:bookmarks',  
            'size' => 'required',
            'quantity' => 'required|numeric',
            'publisher' => 'required',
            'stock_status' => 'required',
            'featured'=>'required',
            'image'=> 'required|image|mimes:jpg,jpeg,png|dimensions:width=300,height=900',
           

            ]);
            $bookmark = new Bookmark();
            $bookmark->title = $request->title;
            $bookmark->arabic_title = $request->arabic_title;
            $bookmark->maker_name = $request->maker_name;
            $bookmark->arabic_maker_name = $request->arabic_maker_name;
            $bookmark->description= $request->description;
            $bookmark->arabic_description= $request->arabic_description;
            $bookmark->bookmark_id = $request->bookmark_id;
            $bookmark->size= $request->size;
            $bookmark->quantity =$request->quantity;
            $bookmark->user_id = $request->publisher;
            $bookmark->stock_status = $request->stock_status;
            $bookmark->featured = $request->featured;
            $bookmark->status = true;
            $bookmark->image = "null"; 
            $bookmark->save();
            $updatebookmark = Bookmark::find($bookmark->id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookmarks/".$bookmark->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updatebookmark->image = $filePath;
            $updatebookmark->update();   
            $productPrice= new ProductPrice();
            $productPrice->product_id= $bookmark->id;
            $productPrice->product_type= 'bookmark';
            $productPrice->price =$request->price;
            $productPrice->currency_id= 1;
            $productPrice->save();
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
        $bookmark = Bookmark::with('users','product_prices')->findOrFail($id);
      
        $user = User::role('publisher')->get();
        return view('bookmarks.edit', compact('bookmark','user'));
       
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
            'arabic_title' => 'required',
            'maker_name' => 'required',
            'arabic_maker_name' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
            'price' => 'required|numeric',
            'bookmark_id' => 'required|numeric|unique:bookmarks,bookmark_id,'.$id,  
            'size' => 'required',
            'quantity' => 'required|numeric',
            'publisher' => 'required|numeric',
            'image'=> 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:width=300,height=900',
            'stock_status' => 'required',
            'featured'=>'required'
            ]);
        $bookmark = Bookmark::find($id);
        $bookmark->title = $request->title;
        $bookmark->arabic_title = $request->arabic_title;
        $bookmark->maker_name = $request->maker_name;
        $bookmark->arabic_maker_name = $request->arabic_maker_name;
        $bookmark->description= $request->description;
        $bookmark->arabic_description= $request->arabic_description;
        $bookmark->bookmark_id = $request->bookmark_id;
        $bookmark->size= $request->size;
        $bookmark->quantity =$request->quantity;
        $bookmark->user_id = $request->publisher;
        $bookmark->stock_status = $request->stock_status;
        $bookmark->featured = $request->featured;
        $bookmark->status = true;
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
