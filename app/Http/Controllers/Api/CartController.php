<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Api\CartRepository;
use App\Helpers\ApiHelper;
use App\Cart;
use App\Http\Requests\Api\CartRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\BookCollection;
use App\Http\Resources\CartResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $model;

    // Constructor to bind model to repo
    public function __construct(Cart $model)
    {
        $this->model =  new CartRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cart = $this->model->all(['books','bookmarks']);
            if(isset($cart)) {
                return new CartResource($cart);
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'No Cart Found');
            }
           
            // $cart = Cart::with('books','bookmarks')->where('user_id',auth()->user()->id
        }
        catch (\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHENTICATED, $e->getMessage());
        }
        
        // dd($cart);
       
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
    public function store(CartRequest $request)
    {
        try{
            $userCart = $this->model->userCart(auth()->user()->id);
            if(isset($userCart)) {
                $cart = $this->model->update($request->all(),$userCart);
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Cart Updated Successfully');
            }
            else {
                $cart = $this->model->create($request->all());
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Cart Created Successfully');
            }
           
           
        }
        catch(\Exception $e) {
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
    public function destroy(Cart $cart)
    {
        try{
            $this->model->delete($cart);
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Cart Deleted Successfully');
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
}
