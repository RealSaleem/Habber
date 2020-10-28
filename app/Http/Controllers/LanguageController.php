<?php

namespace App\Http\Controllers;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $language = Language::all();
        return view('languages.index', compact('language'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $language = Language::all();
        return view('languages.create', compact('language'));
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
            'language' => 'required|unique:languages,name', 
            'status' => 'required' 
        ]);
        $language = new Language();
        $language->name = Str::lower($request->language);
        $language->status = $request->status;
        $language->save();   
        return back()->with('success', 'Language successfully saved');
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
        $language = Language::findOrFail($id);
        return view('languages.edit', compact('language'));
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
            'language' => 'required|unique:languages,name,'.$id,
            'status' => 'required' 
            
        ]);
        $language =Language::find($id);
        $language->name = Str::lower($request->language);
        $language->status = $request->status;
        $language->save();   
        return back()->with('success', 'Language updated successfully ');
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
        $language = Language::findOrFail($id);
        $language->delete();
        return back()->with('success', 'Language deleted successfully');
    }
}
