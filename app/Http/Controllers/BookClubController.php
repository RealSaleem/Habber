<?php

namespace App\Http\Controllers;
use App\BookClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookclub = BookClub::all();
        return view('bookclub.index', compact('bookclub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bookclub = BookClub::all();
        return view('bookclub.create',compact('bookclub'));

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
            'name' => 'required', 
            'banner_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $bookclub = new BookClub();
        $bookclub->name = $request->name;
        $file = $request->banner_image;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "bookclub/" . $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
        $bookclub->banner_image = $filePath;
        $bookclub->save();   
        return back()->with('success', 'Bookclub successfully saved');

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
        $bookclub = BookClub::findOrFail($id);
        return view('bookclub.edit', compact('bookclub'));
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
            'name' => 'required', 
            'banner_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $bookclub = BookClub::find($id);
        $bookclub->name = $request->name;
        if($request->has('banner_image')) 
        {
            $file = $request->banner_image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookclub/" . $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $bookclub->banner_image =  $filePath;
        }
        $bookclub->save();   
        return back()->with('success', 'User updated sucessfully');
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
        $bookclub = BookClub::findOrFail($id);
        $bookclub->delete();
        return back()->with('success', 'Bookclub deleted successfully');
    }
}
