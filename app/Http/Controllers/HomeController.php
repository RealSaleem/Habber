<?php

namespace App\Http\Controllers;
use App;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public  function setLanguage($locale) 
    {
        // dd($locale);
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
