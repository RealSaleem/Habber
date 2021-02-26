<?php

namespace App\Http\Controllers;
use App;
use Session;
use App\User;
use App\Order;
use App\BookClub;
use App\OrderProduct;
use App\Book;
use App\Bookmark;
use App\Events\ShowNotificationEvent;
use App\Helpers\ApiHelper;

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
        $user =auth()->user()->id;
        Session::put('user',$user);
        $user1 =User::with('businesses')->role('publisher')->find(auth()->user()->id);
        Session::put('users1',$user1);
        $fromUser=auth()->user();
        Session::put('users',$fromUser);
        $userDetail = User::count();
       $publisherDetail= User::role('publisher')->count();
       $pendingOrder= Order::where('status','pending')->count();
       $totalOrder = Order::count();
       $orderDetail= OrderProduct::where('user_id',auth()->user()->id)->count();
       $bookclubDetail = BookClub::count(); 
       $totalProduct = Book::count() + Bookmark::count(); 
       $totalProducts = Book::where('user_id',auth()->user()->id)->count() + Bookmark::where('user_id',auth()->user()->id)->count(); 
       event(new ShowNotificationEvent());
      // ApiHelper::getData();
                  
return view('welcome',compact('orderDetail','userDetail','totalProduct','totalProducts', 'publisherDetail','totalOrder','bookclubDetail','pendingOrder','fromUser'));
    }
       
    

    public  function setLanguage($locale) 
    {
        // dd($locale);
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
  
   

}