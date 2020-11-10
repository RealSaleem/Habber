<?php

namespace App\Http\Controllers\Api;
use App\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\SiteSettingResource;

class SiteSettingController extends Controller
{
    public function index() {
        try {
            $siteSetting = SiteSetting::with('languages','currencies')->first();
            return new SiteSettingResource($siteSetting);
        }
        catch( \Exception $e) {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
       
    }
}
