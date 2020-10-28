<?php

namespace App\Http\Controllers\Api;
use App\BookClub;
use App\Repositories\Api\BookclubRepository;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Http\Resources\BookclubCollection;
use App\Http\Resources\BookclubResource;

class BookclubController extends Controller
{
    protected $model;
    
    
    public function __construct(BookClub $model) {
        $this->model = new BookclubRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $BookClubs = BookClub::where('featured',1)->get();
            if(count($BookClubs) != 0) {
                return (new BookclubCollection($BookClubs));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Book Clubs Found");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
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
        try {
            $BookClubs = $this->model->show($id);
            if(isset($BookClubs)) {
                return (new BookclubResource($BookClubs));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Book Club Found");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
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
