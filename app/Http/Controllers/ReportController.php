<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\OrderProduct;
use App\User;
use App\Currency;
use DB;
use DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $total_price=0;
 if(request()->ajax())
        {
         if(!empty($request->to))
         {
       
          $data=OrderProduct::
            select('order_id', 'publisher_name', 'price','currency_iso')
            ->where('created_at','>=' ,$request->to)
            ->where('created_at','<=' ,$request->from)
            ->get();
         } 
         else
         {
          $data = OrderProduct::
            select('order_id', 'publisher_name', 'price','currency_iso')
            ->orderBy('user_id','ASC')->get();

         }
         return  Datatables::of($data)
         ->addIndexColumn()
         ->addColumn('action', function($row){

                $btn = '<a href="reports1"  data-toggle="tooltip"  data-id="'.$row->id.'" class="edit btn btn-info btn-sm">View</a>';

                 return $btn;
         })
         ->rawColumns(['action'])
         ->make(true);

        }
     
        
        $curr=auth()->user()->currency_id;
        $rate=Currency::find($curr);
        $iso=$rate->iso;
        $rate1=$rate->rate;
        return view('reports.sales',compact('rate1','iso'));
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
    public function index1(Request $request)
    {
        //
        {    $total_price=0;
            if(auth()->user()->hasRole('publisher')){
           {
                if(request()->ajax())
                       {
                        if(!empty($request->to))
                        {
                      
                         $data=OrderProduct::
                           select('order_id', 'price','currency_iso')
                           ->where('created_at','>=' ,$request->to)
                           ->where('created_at','<=' ,$request->from)
                           ->where('user_id',auth()->user()->id)
                           ->get();
                        } 
                        else
                        {
                         $data = OrderProduct::
                           select('order_id', 'price','currency_iso')
                           ->where('user_id',auth()->user()->id)
                           ->orderBy('user_id','ASC')->get();
               
                        }
                        return datatables()->of($data)->make(true);
                       }}
            
            $curr=auth()->user()->currency_id;
            $rate=Currency::find($curr);
            $iso=$rate->iso;
            $rate1=$rate->rate;
            return view('reports.publisher',compact('rate1','iso'));
        }
    }}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
   
    {    $total_price=0;
 if(request()->ajax())
        {
         if(!empty($request->name))
         {
           
          $data=OrderProduct::
            select('order_id', 'publisher_name', 'price','currency_iso')
            ->where('publisher_name',$request->name)
            ->get();
         } 
         else
         {
          $data = OrderProduct::
            select('order_id', 'publisher_name', 'price','currency_iso')
            ->get();

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