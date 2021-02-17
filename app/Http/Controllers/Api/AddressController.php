<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Api\AddressRepository;
use App\Helpers\ApiHelper;
use App\Address;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddressRequest;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;


class AddressController extends Controller
{

    protected $model;

    public function __construct(Address $model) {
        $this->model = new AddressRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(AddressRequest $request)
    {
        try {
            $address = $this->model->create($request->all());
            return (new AddressResource($address));
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
    public function showUserAddresses()
    {
        try {
            $address = $this->model->userAddresses();
            if(count($address) > 0) {
                return (new AddressCollection($address));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,'No Addresses found!');
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $address = $this->model->show($id);
            return (new AddressResource($address));
        }
        catch(\Exception $e) {
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
    public function update(AddressRequest $request,$id)
    {
        $address = Address::find($id);
        $address->address_name = $request->address_name;
        $address->address_line1 = $request->address_line1;
        $address->address_line2= $request->address_line2;
        $address->city_id= $request->city_id;
        $address->state = $request->state; 
        $address->country_id = $request->country_id;
        $address->post_code= $request->post_code;
        $address->phone= $request->phone;
        $address->update();   
        return (new AddressResource($address));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $address = Address::findOrFail($id);
            $address->status=0;
            $address->update();

         return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,'Address Deleted Successfully!');
            
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
}
