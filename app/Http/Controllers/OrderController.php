<?php

namespace App\Http\Controllers;
use App\Events\OrderStatusChangedEvent;
use App\Events\OrderCancelledEvent;
use App\Events\OrderSuccessEvent;
use App\Order;
use App\User;
use App\Address;





use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $order= Order::with('addresses')->get();
        $address= Address::all();
        return view('orders.index', compact('order','address'));
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
        $order = Order::with('books','bookmarks','addresses','users','currencies')->find($id);
        return view('orders.detail', compact('order'));
    
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
            $order = Order::find($id);
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
            $order->status = false;
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
            $order->status = true;
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
    

    



