<?php

namespace App\Http\Controllers;
use App\Events\OrderStatusChangedEvent;
use App\Events\OrderCancelledEvent;
use App\Events\OrderSuccessEvent;
use App\Order;
use App\User;
use App\Address;
use App\OrderProduct;
use App\Book;
use App\Bookmark;





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
            $order = OrderProduct::where('user_id',auth()->user()->id)->get(); 
            $fromUser=auth()->user();
            return view('orders.index1', compact('order','fromUser'));
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
        if(auth()->user()->hasRole('admin')){
        $order = Order::with('books','bookmarks','addresses','users','currencies','order_product')->find($id);
        return view('orders.detail', compact('order'));}
        if(auth()->user()->hasRole('publisher')){
            $idd=$id;
            $books=array();
            $bookmarks=array();
            $order = OrderProduct::where('order_id',$id)->get();
            foreach($order as $o){
                if($o->product_type=='book' && $o->user_id==auth()->user()->id){
            $book=Book::find($o->product_id);
            array_push($books,$book);
                }
            else if($o->product_type=='bookmark' && $o->user_id==auth()->user()->id){
                    $bookmark=Bookmark::find($o->product_id);
                    array_push($bookmarks,$bookmark);
                        }
            }
            return view('orders.detail1', compact('order','books','bookmarks','idd'));
        }
    
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
        if($request->status== 'Select the option'){ return back()->with('error', 'Please Select Order  Status !');}
        try{
            $order = Order::with('books','bookmarks')->find($id);
            //if($request== null){ return back()->with('success', 'Please Select Order  Status !');}
            if($order->status!=$request->status){
            $order->status = $request->status;
            $order->update();
            
           event(new OrderStatusChangedEvent($order));
            }
            if($request->has('book_id')){
         $product=OrderProduct::where('order_id',$order->id)->where('product_id',$request->book_id)->first();
           $product->product_status=$request->product_status;
           $product->update();}
           if($request->has('bookmark_id')){
            $product1=OrderProduct::where('order_id',$order->id)->where('product_id',$request->bookmark_id)->first();
            $product1->product_status=$request->product_status1;
             $product1->update();}
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
    public function update1(Request $request,$id){
        if($request->has('book_id')){
            $product=OrderProduct::where('order_id',$id)->where('product_id',$request->book_id)->first();
              $product->product_status=$request->product_status;
              $product->update();}
              if($request->has('bookmark_id')){
               $product1=OrderProduct::where('order_id',$id)->where('product_id',$request->bookmark_id)->first();
               $product1->product_status=$request->product_status1;
                $product1->update();}
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
    

    



