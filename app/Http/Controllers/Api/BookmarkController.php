<?php


namespace App\Http\Controllers\Api;
use App\Bookmark;
use App\Repositories\Api\BookmarkRepository;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Http\Resources\BookmarkCollection;
use App\Http\Resources\BookmarkResource;
use App\User;


class BookmarkController extends Controller
{
    protected $model;
    
    
    public function __construct(Bookmark $model) {
        $this->model = new BookmarkRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $bm=array();
            $bookmarks = $this->model->with('users','product_prices')->where('status',1)->orderBy('id','DESC')->paginate(100);
            foreach($bookmarks as $bookmark){
                $user=User::findOrFail($bookmark->user_id);
                if($user->status==1){
                    array_push($bm,$bookmark);
                }
            }
            if(count($bm) != 0) {
               
                return (new BookmarkCollection($bm));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Bookmarks Found");
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
            $bookmark = $this->model->show($id);
            if(isset($bookmark)) {
                return (new BookmarkResource($bookmark));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Bookmark Found!");
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
