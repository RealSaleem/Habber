<?php

namespace App\Http\Controllers;
use App;
use Session;
use App\User;
use App\Order;
use App\BookClub;
use App\Book;
use App\Bookmark;

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
        $userDetail = User::count();
       $publisherDetail= User::role('publisher')->count();
       $pendingOrder= Order::where('status','pending')->count();
       $totalOrder = Order::count();
       $bookclubDetail = BookClub::count(); 
       $totalProduct = Book::count() + Bookmark::count(); 
        return view('welcome',compact('userDetail','totalProduct', 'publisherDetail','totalOrder','bookclubDetail','pendingOrder'));
    }
       
    

    public  function setLanguage($locale) 
    {
        // dd($locale);
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
  
}
