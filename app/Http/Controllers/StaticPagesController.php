<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\StaticPage;
use Illuminate\Support\Facades\URL;

class StaticPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $static = StaticPage::all();
       return view('static_pages.index', compact('static'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('static_pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'title'         => 'required|min:3|max:255',
            'arabic_title'         => 'required|min:3|max:255',
            'url'          => 'min:3|max:255|unique:static_pages',
            'ar-description'   => 'required|min:3',
            'en-description'   => 'required|min:3'
        ]);
    
        $validatedData['url'] = Str::slug($validatedData['title'], '-');
    
        $static = new StaticPage();
        $static->title = $validatedData['title'];
        $static->arabic_title = $validatedData['arabic_title'];
        $static->url = $validatedData['url'];
        $static->description = $validatedData['en-description'];
        $static->arabic_description = $validatedData['ar-description'];
        $static->save();
        return back()->with('success', 'Page Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url,$lang)
    {   if($lang=='en'){
         $static_page=StaticPage::where('url',$url)->first();
         $title=$static_page->title;
         $description=$static_page->description;
        return view('static_pages.static_page',compact('title','description'));}
        else if($lang=='ar'){
            $static_page=StaticPage::where('url',$url)->first();
            $title=$static_page->arabic_title;
            $description=$static_page->arabic_description;
           return view('static_pages.static_page',compact('title','description'));}

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $static_page=StaticPage::where('url',$url)->first();
        return view('static_pages.edit',compact('static_page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
     
    public function update(Request $request, $url)
    {
       
        $validatedData = $this->validate($request, [
            'title'         => 'required|min:3|max:255',
            'arabic_title'         => 'required|min:3|max:255',
            'url'          => 'min:3|max:255|unique:static_pages',
            'ar-description'   => 'required|min:3',
            'en-description'   => 'required|min:3'
        ]);
    
        $validatedData['url'] = Str::slug($validatedData['title'], '-');
    
        $static =StaticPage::where('url',$url)->first();
        $static->title = $validatedData['title'];
        $static->arabic_title = $validatedData['arabic_title'];
        $static->url = $validatedData['url'];
        $static->description = $validatedData['en-description'];
        $static->arabic_description = $validatedData['ar-description'];
        $static->update();
        return redirect('/admin/static_pages')->with('success', 'Page Updated Successfully!');
    }

    public function getLink(){
     $links = array (
            'about_us_url'=> URL::to("/").'/admin/static_pages/about-us/en',
            'privacy_policy_url' => URL::to("/").'/admin/static_pages/privacy-policy/en',
            'return_policy_url' => URL::to("/").'/admin/static_pages/return-policy/en',
            'terms_and_condition_url' => URL::to("/").'/admin/static_pages/terms-and-conditions/en',
            'about_us_url_ar'=> URL::to("/").'/admin/static_pages/about-us/ar',
            'privacy_policy_url_ar' => URL::to("/").'/admin/static_pages/privacy-policy/ar',
            'return_policy_url_ar' => URL::to("/").'/admin/static_pages/return-policy/ar',
            'terms_and_condition_url_ar' => URL::to("/").'/admin/static_pages/terms-and-conditions/ar');
            return $links;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $static = StaticPage::findOrFail($id);
        $static->delete();
        return back()->with('success', 'Page Deleted Successfully!');
    }
}
