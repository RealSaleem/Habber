<?php

namespace App\Http\Controllers;
use App\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:favourite-list|favourite-create|favourite-edit|favourite-delete', ['only' => ['index','show']]);
        $this->middleware('permission:favourite-create', ['only' => ['create','store']]);
        $this->middleware('permission:favourite-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:favourite-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $favourites = Favourite::with('books','bookmarks','users')->where('user_id',$id)->get();
        return view('favourites.index',compact('favourites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fav = Favourite::with('books','bookmarks','users')->find($id);
        return view('favourites.detail',compact('fav'));
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
    }
}
