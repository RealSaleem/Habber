<?php

namespace App\Http\Controllers\Api;
use App\Book;
use Validator;
use App\Repositories\Api\BookRepository;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    protected $model;

    public function __construct(Book $model) {
        $this->model = new BookRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $books = $this->model->with(['book_clubs','genres','product_prices','users'])->where('status',1)->get();
            if(count($books) != 0) {
                return (new BookCollection($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Books Found");
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

    public function arabicBooks()
    {
        try {
            $books = $this->model->with('genres')->where('status',1)->where('book_language','arabic')->get();
            if(count($books) != 0) {
                return (new BookCollection($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Books Found");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }

    public function englishBooks()
    {
        try {
            $books = $this->model->with('genres')->where('status',1)->where('book_language','english')->get();
            if(count($books) != 0) {
                return (new BookCollection($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Books Found");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($isbn)
    {
        try {
            $books = $this->model->findByIsbn($isbn);
            if(isset($books)) {
                return (new BookResource($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Book Found!");
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

    public function relatedBooks($id)
    {
        try {
            $books = $this->model->relatedGenreBooks($id);
            if(isset($books)) {
                return (new BookCollection($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Related Book Found!");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
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

    public function searchBook(Request $request) {
        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string'
        ]);
        try {
            $books = $this->model->bookSearch($request->keyword);
            if(isset($books)) {
                return (new BookCollection($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Book Found!");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }

    public function filterBook(Request $request) {
        $validator = Validator::make($request->all(), [
            'genre' => 'required|array|between:1,3'
        ]);
        
        try {
            $books = $this->model->filterByGenre($request->genre);
            if(isset($books)) {
                return (new BookCollection($books));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Book Found!");
            }
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
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
    }
}
