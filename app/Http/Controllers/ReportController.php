<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Order;
use App\User;
use App\Currency;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {if(auth()->user()->hasRole('admin')){
        $dt = new DateTime();
    
        $total_price = Order::sum('total_price');
   
       

       $order = Order::get();
       $totalOrder = 0;
       $publishers = User::with('books','bookmarks')->role('publisher')->get();
       $oo= array();
       $fromUser=auth()->user();
  
       return view('reports.sales', compact('publishers','total_price','dt','fromUser'));}
    
        else if(auth()->user()->hasRole('publisher')){
            $dt = new DateTime();
    
            $total_price = Order::sum('total_price');
       
            $order = Order::where('user_id',auth()->user()->id)->get(); 
            $totalOrder = 0;
       $publishers = User::with('books','bookmarks')->role('publisher')->get();
       $oo= array();
       $fromUser=auth()->user();
       return view('reports.sales', compact('publishers','total_price','dt','fromUser'));
        }
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
        
        $publisher = User::with('books','bookmarks')->role('publisher')->where('id',$id)->first();
       
        $oo= array();
        $currency=array();
        if(count($publisher->books ) > 0) {
            
            foreach($publisher->books as $b) {
                array_push($oo, $b->orders);
                foreach($oo as $o){
                $currency=Currency::findORfail($o>['currency_id']);}

            }
        }
    
        if (count($publisher->bookmarks ) > 0) {
            
            foreach($publisher->bookmarks as $bm) {
               array_push($oo, $bm->orders);

                
            }
        }
        



     
        return view('reports.detail',compact('oo','publisher'));
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
