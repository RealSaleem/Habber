<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Api\OrderRepository;
use App\Repositories\Api\CartRepository;
use App\Helpers\ApiHelper;
use App\Order;
use App\Cart;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Http\Resources\OrderResource;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends Controller
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
        {

            try {
                $order = Order::with('books','bookmarks')->get();
                if(isset($order)) {
                    return InvoiceResource::collection($order);
                }
              
                else {
                    return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'No Invoice Found');
                }
               
                // $cart = Cart::with('books','bookmarks')->where('user_id',auth()->user()->id
            }
            catch (\Exception $e) {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
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
        public function store(OrderRequest $request)
      {

      }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //   {

            try {
                $order = Order::with('books','bookmarks')->get();
                if(isset($order)) {
                    return InvoiceResource::collection($order);
                }
              
                else {
                    return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'No Invoice Found');
                }
               
                // $cart = Cart::with('books','bookmarks')->where('user_id',auth()->user()->id
            }
            catch (\Exception $e) {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
            }
            
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
    
