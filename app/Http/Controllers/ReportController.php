<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\OrderProduct;
use App\User;
use App\Currency;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $total_price=0;
        if(auth()->user()->hasRole('admin')){
 if(request()->ajax())
        {
         if(!empty($request->to))
         {
       
          $data=OrderProduct::
            select('order_id', 'publisher_name', 'price','currency_iso')
            ->where('created_at','>=' ,$request->to)
            ->where('created_at','<=' ,$request->from)
            ->orderBy('order_id','ASC')->get();
         } 
         else
         {
          $data = OrderProduct::
            select('order_id', 'publisher_name', 'price','currency_iso')
            ->orderBy('order_id', 'ASC')->get();

         }
         return datatables()->of($data)->make(true);
        }}
      else if(auth()->user()->hasRole('publisher')){
            if(request()->ajax())
                   {
                    if(!empty($request->to))
                    {
                  
                     $data=OrderProduct::
                       select('order_id', 'publisher_name','price','currency_iso')
                       ->where('created_at','>=' ,$request->to)
                       ->where('created_at','<=' ,$request->from)
                       ->where('user_id',auth()->user()->id)
                       ->orderBy('order_id','ASC');
                    } 
                    else
                    {
                     $data = OrderProduct::
                       select('order_id','publisher_name',  'price','currency_iso')
                       ->where('user_id',auth()->user()->id)
                       ->orderBy('order_id', 'ASC')->get();

                    }
                    return datatables()->of($data)->make(true);
                   }}
        
        $curr=auth()->user()->currency_id;
        $rate=Currency::find($curr);
        $iso=$rate->iso;
        $rate1=$rate->rate;
        return view('reports.sales',compact('rate1','iso'));
    }
   
   
       
           

    public function report(Request $request)
    
    {if(auth()->user()->hasRole('admin')){
        $dt = new DateTime();
    
        $total_price = Order::sum('total_price');
   
       

       $order = Order::get();
       $totalOrder = 0;
       $publishers = User::with('books','bookmarks')->role('publisher')->get();
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
  
       return view('reports.sales', compact('dt','fromUser','total_price','orders','currency'));}
    
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
                    if(request()->ajax())
                    {
                     if(!empty($request->from))
                     {
                    foreach(array_unique($oo) as $o){
                        array_push($orders,Order::with('currencies')->where('created_at','>=',$request->to)->where('created_at','<=',$request->from)->find($o));
                    }}
                else{
                    foreach(array_unique($oo) as $o){
                        array_push($orders,Order::with('currencies')->find($o));
                    } 
                }
                return datatables()->of($orders)->make(true);}
               


       $fromUser=auth()->user();
    
       return view('reports.sales', compact('dt','fromUser','total_price','orders','currency'));
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
    public function show(Request $request)
    {   $total_price=0;
 if(request()->ajax())
        {
         if(!empty($request->name))
         {
       
          $data=OrderProduct::
            select('order_id','publisher_name', 'price','currency_iso')
            ->where('publisher_name',$request->name)
            ->get();
         } 
         else
         {
          $data = OrderProduct::
            select('order_id','publisher_name','price','currency_iso')
            ->orderBy('order_id','ASC')->get();

         }
         return datatables()->of($data)->make(true);
        }
        $curr=auth()->user()->currency_id;
        $rate=Currency::find($curr);
        $iso=$rate->iso;
        $rate1=$rate->rate;
        return view('reports.detail',compact('rate1','iso'));
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
