<?php

namespace App\Http\Controllers;
use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:genre-list|genre-create|genre-edit|genre-delete', ['only' => ['index','show']]);
        $this->middleware('permission:genre-create', ['only' => ['create','store']]);
        $this->middleware('permission:genre-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:genre-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $genre = Genre::all();
        return view('genres.index', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $genre = Genre::all();
        return view('genres.create', compact('genre'));
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
            
        ]);
        $genre = new Genre();
        $genre->title = $request->title;
        $genre->arabic_title = $request->arabic_title;
        $genre->save();   
        return back()->with('success', 'Genre successfully saved');

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
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
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
            'arabic_title' => 'required' 
            
        ]);
        $genre =  Genre ::find($id);
        $genre->title = $request->title;
        $genre->arabic_title = $request->arabic_title;
        $genre->save();   
        return back()->with('success', 'Genre updated successfully ');

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
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return back()->with('success', 'Genre deleted successfully');
    }
}
