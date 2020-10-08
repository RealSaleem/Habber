<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Repositories\Api\UserRepository;
use App\Helpers\ApiHelper;
use App\Favourite;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Http\Resources\FavouriteCollection;
use App\Http\Resources\FavouriteResource;


class FavouriteController extends Controller
{
    protected $model;
    
    
    public function __construct(Favourite $model) {
        $this->model = new UserRepository($model);
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
    public function store(Request $request)
    {
        try{
            $favourite = $this->model->createFavourite($request->all());
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, 'Favourites Submitted Successfully');
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
        try{
            $favourites = $this->model->getUserFavourites($id);
            if(isset($favourites)) {
                return (new FavouriteCollection($favourites));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,'No favourites found!');
            }
           
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
