<?php

namespace App\Http\Controllers\Api;
use App\Language;
use App\Helpers\ApiHelper;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\LanguageCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index() {
        try {
            
            $language = Language::where('status',1)->get();
            return (new LanguageCollection($language));
        }
        catch(\Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, $e->getMessage());
        }
    }
}
