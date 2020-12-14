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
            'url'          => 'min:3|max:255|unique:static_pages',
            'w3review'   => 'required|min:3'
        ]);
    
        $validatedData['url'] = Str::slug($validatedData['title'], '-');
    
        $static = new StaticPage();
        $static->title = $validatedData['title'];
        $static->url = $validatedData['url'];
        $static->description = strip_tags($validatedData['w3review']);
        $static->save();
        return redirect()->route('static_pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {    
        $static_page=StaticPage::where('url',$url)->first();
        return view('static_pages.static_page',compact('static_page'));
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

     public function link($url){
        try {
            $static = StaticPage::where('url',$url)->first();
            return (new GroupResource($static));
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }
     
    public function update(Request $request, $url)
    {
       
        $validatedData = $this->validate($request, [
            'title'         => 'required|min:3|max:255',
            'url'          => 'min:3|max:255|unique:static_pages',
            'w3review'   => 'required|min:3'
        ]);
    
        $validatedData['url'] = Str::slug($validatedData['title'], '-');
    
        $static =StaticPage::where('url',$url)->first();
        $static->title = $validatedData['title'];
        $static->url = $validatedData['url'];
        $static->description = strip_tags($validatedData['w3review']);
        $static->save();
        return back()->with('success', 'Page Updated Successfully!');
    }

    public function pro(){

            $about_us_url=URL::to("/").'/static_pages/about-us';
            $privacy_policy_url = URL::to("/").'/static_pages/privacy-policy';
            $return_policy_url = URL::to("/").'/static_pages/return-policy';
            $terms_and_condition_url = URL::to("/").'/static_pages/terms-and-conditions';
            return $about_us_url;
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
