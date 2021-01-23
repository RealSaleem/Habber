<?php

namespace App\Http\Controllers\Api;
use App\Genre;
use App\Helpers\ApiHelper;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\GenreCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        try {
            
            $genre = Genre::all();
            return (new GenreCollection($genre));
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
}
