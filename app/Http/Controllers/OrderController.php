<?php

namespace App\Http\Controllers;
use App\Events\OrderStatusChangedEvent;
use App\Events\OrderCancelledEvent;
use App\Events\OrderSuccessEvent;
use App\Order;
use App\User;
use App\Address;
use App\OrderProduct;





use Illuminate\Http\Request;

class OrderController extends Controller
{    
    public function __construct()
    {
       $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index','show']]);
       $this->middleware('permission:order-create', ['only' => ['create','store']]);
       $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {if(auth()->user()->hasRole('admin')){
        $order = Order::with(['addresses'])->get();   
        $address= Address::all();   
     
        $fromUser=auth()->user();
        return view('orders.index', compact('order','address','fromUser'));
    }
        else if(auth()->user()->hasRole('publisher')){
            $order = Order::with(['addresses'])->where('user_id',auth()->user()->id)->get(); 
            $address= Address::all();   
            $fromUser=auth()->user();
            return view('orders.index', compact('order','address','fromUser'));
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
        $order = Order::all();

        return view('orders.create', compact('order'));
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
        //
        $order = Order::with('books','bookmarks','addresses','users','currencies','order_product')->find($id);
        return view('orders.detail', compact('order'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function showlist($id)
    {
        $order = Order::with('addresses')->find($id);
        return view('orders.shipping',compact('order'));
    }
    public function edit($id)
    {
        //
        $order = Order::findOrFail($id);
        $user = User::where('id', '!=', 1)->get();
        return view('orders.edit', compact('order','user'));
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
        $error = false;
        try{
            $order = Order::with('books','bookmarks')->find($id);
            $order->status = $request->status;
            $order->update();
           event(new OrderStatusChangedEvent($order));
          return back()->with('success', 'Status Updated Successfully!');
        }
        catch(\Exception $e) {
           
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return back()->with('success', $message);
        }
    }
    public function update1(Request $request){
        $order = Order::with('books','bookmarks')->find($request->id);
              
            $product=OrderProduct::where('order_id',$order->id)->where('product_id',$request->oo)->first();
           $product->product_status=$request->o;
            $product->update();
            return back()->with('success', 'Status Updated Successfully!');
    }
    public function update2(Request $request){
        $order = Order::with('books','bookmarks')->find($request->id);
           $product1=OrderProduct::where('order_id',$order->id)->where('product_id',$request->oo)->first();
           $product1->product_status=$request->o;
            $product1->update();
            return back()->with('success', 'Status Updated Successfully!');
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
       $order = Order::findOrFail($id);
        $orders=Order::with('books','bookmarks')->where('id',$id)->first();
       if(count($orders->books)!=null){
        foreach($orders->books as $book){
           $book->quantity+=$book['pivot']->quantity; 
           $book->update();
        }}
        if(count($orders->bookmarks)!=null){
        foreach($orders->bookmarks as $bookmark){
            $bookmark->quantity+=$bookmark['pivot']->quantity; 
            $bookmark->update();
         }}
        $order->delete();
        event(new OrderCancelledEvent($order));
        return back()->with('success', 'Order Deleted Successfully!');
    }
    public function getUserOrderList($id)
    {
        $order = Order::where('user_id',$id)->get();
    
        $fromUser = User::find($id);
        return view('orders.index', compact('order','fromUser'));
    }
   
    public function readyOrder($id) {
        $error = false;
        try {
            $order = Order::findOrFail($id);
            $order->order_status = false;
            $order->save();
            return 'true';
        }
        catch(\Exception $e) {
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return $message;
        }

    }

    public function notreadyOrder($id) {
        $error = false;
        try {
            $order = Order::findOrFail($id);
            $order->order_status = true;
            $order->save();
            return 'true';
        }
        catch(\Exception $e) {
           $error = true;
           $message = $e->getMessage(); 
        }
        if($error) {
            return $message;
        }
    
    }
}
    

    



