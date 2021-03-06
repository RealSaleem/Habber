<?php


namespace App\Http\Controllers\Api;
use App\Repositories\Api\OrderRepository;
use App\Repositories\Api\CartRepository;
use App\Helpers\ApiHelper;
use App\Order;
use App\Cart;
use App\Http\Requests\Api\OrderRequest;
use App\Events\OrderSuccessEvent;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $model,$cart;

    // Constructor to bind model to repo
    public function __construct(Order $model,Cart $cart)
    {
        $this->model =  new OrderRepository($model);
        $this->cart =  new CartRepository($cart);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     if(auth()->user()->hasRole('admin')){
        try {
            $order = Order::with(['books','bookmarks'])->orderBy('id','DESC')->get();
            if($order!=null){
                return OrderResource::collection($order);
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'No Orders Found');
            }
           
            // $cart = Cart::with('books','bookmarks')->where('user_id',auth()->user()->id
        }
        catch (\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
    else{
        try {
           ;
            $order = Order::with(['books','bookmarks'])->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
            if($order!=null){
                return OrderResource::collection($order);
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'No Orders Found');
            }
           
            // $cart = Cart::with('books','bookmarks')->where('user_id',auth()->user()->id
        }
        catch (\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }}
    
    }

    /**
     * Show the form for creating a new resource.
     *+
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
    public function store(OrderRequest $request)
    {
        try {
            //$order = $this->model->userCart(auth()->user()->id);
           // dd($order);
        //     if(isset($order)) {
        //         $order = Order::where('status','Payment Failed')->first();
        //        if($order!=null){
        //         $order = $this->model->update($request->all(),$order);
        //         return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Order Updated Successfully');
        //     }
        // }
            $order = $this->model->create($request->all());
            if ($order == false) {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_OK, 'Order Creation UnSuccessfull! Some Products ran out of stock');
            }
             else {
                $cart=Cart::where('user_id',auth()->user()->id)->first();
                if($cart==null){return ApiHelper::apiResult(false,HttpResponse::HTTP_OK, 'Can not place order because cart is empty');}
                if($order->payment_type!='online'){
                    event(new OrderSuccessEvent($order));
                    $cart->delete();
                }
                return (new OrderResource($order));
               return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Order Created Successfully');
             }
           
            }
        catch (\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
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

    public function CancelPayment(Request $request) {
    
        $orderId = $request->id;
        $order = Order::find($orderId);
        $order->status='Payment Failed';
        $order->payment_status='Failed';
        $order->payment_message='Incomplete details provided';
        $order->update();
        return true;
    }
}
