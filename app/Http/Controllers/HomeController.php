<?php

namespace App\Http\Controllers;
use App;
use Session;
use User;
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
        $user = User::with('users')->get();
        return view('welcome',['users' => $users]);
       
    }

    public  function setLanguage($locale) 
    {
        // dd($locale);
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
  
}
