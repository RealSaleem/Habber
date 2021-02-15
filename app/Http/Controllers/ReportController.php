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
    public function index(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
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
            $oo=array();
            $total_price1=0;
       $total_price2=0;
       $total_price=0;
       $currency="";
            $publishers = User::with('books','bookmarks')->role('publisher')->where('id',auth()->user()->id)->get();
            foreach($publishers as $publisher){
                if(count($publisher->books ) > 0){
                foreach($publisher->books as $b){
                foreach($b->orders as $k){
                    array_push($oo,$k['id']);
                 $total_price1+=$k['total_price'];
                }
            }
        }
        if(count($publisher->bookmarks ) > 0){
            foreach($publisher->bookmarks as $bm){
            foreach($bm->orders as $kk){
                array_push($oo,$kk['id']);
             $total_price2+=$kk['total_price'];
            
            }
        }
    }
    $currency=Currency::find($publisher['currency_id']);  }
    $orders=[];
                    $total_price= $total_price2+ $total_price2;
                    $currency=$currency['iso'];
                    foreach(array_unique($oo) as $o){
                        array_push($orders,Order::with('currencies')->find($o));
                    }
               


       $fromUser=auth()->user();
    }
       return view('reports.sales', compact('publishers','dt','fromUser','total_price','orders','currency'));
        
    }
   
   
    public function report(Request $request){
        if(auth()->user()->hasRole('admin')){
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
                $oo=array();
                $total_price1=0;
           $total_price2=0;
           $total_price=0;
           $currency="";
                $publishers = User::with('books','bookmarks')->role('publisher')->where('id',auth()->user()->id)->get();
                
                foreach($publishers as $publisher){
                    if(count($publisher->books ) > 0){
                    foreach($publisher->books as $b){
                    foreach($b->orders as $k){
                        if($k->created_at>=$request->o && $k->created_at<=$request->oo){
                            
                        
                        array_push($oo,$k['id']);
                     $total_price1+=$k['total_price'];}
                    }
                }
            }
            if(count($publisher->bookmarks ) > 0){
                foreach($publisher->bookmarks as $bm){
                foreach($bm->orders as $kk){
                    if($kk->created_at>=$request->o && $kk->created_at<=$request->oo){
                    array_push($oo,$kk['id']);
                 $total_price2+=$kk['total_price'];
                
                }}
            }
        }
        $currency=Currency::find($publisher['currency_id']);  }
        $orders=[];
                        $total_price= $total_price2+ $total_price2;
                        $currency=$currency['iso'];
                        foreach(array_unique($oo) as $o){
                            array_push($orders,Order::with('currencies')->find($o));
                        }
                   
    
    
           $fromUser=auth()->user();
        }
           return redirect('reports.sales', compact('publishers','dt','fromUser','total_price','orders','currency'));
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
