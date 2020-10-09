<?php

namespace App\Http\Controllers\Api;
use App\RequestForBook;
use App\Repositories\Api\UserRequestRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserBookRequest;
use App\Repositories\Api\UserBookRequestRepository;
use App\Helpers\ApiHelper;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class UserRequestController extends Controller
{
    protected $model;

    public function __construct(RequestForBook $model) {
        $this->model = new UserBookRequestRepository($model);
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
    public function store(UserBookRequest $request)
    {
        try {
            $userRequest = $this->model->create($request->all());
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK, "User's Request Submitted Successfully",$userRequest);
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
}
