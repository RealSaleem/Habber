<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class StaticPageController extends Controller
{
    public function getLink(){
        $links = array (
               'about_us_url'=> URL::to("/").'/static_pages/about-us/en',
               'privacy_policy_url' => URL::to("/").'/static_pages/privacy-policy/en',
               'return_policy_url' => URL::to("/").'/static_pages/return-policy/en',
               'terms_and_condition_url' => URL::to("/").'/static_pages/terms-and-conditions/en',
               'about_us_url_ar'=> URL::to("/").'/static_pages/about-us/ar',
               'privacy_policy_url_ar' => URL::to("/").'/static_pages/privacy-policy/ar',
               'return_policy_url_ar' => URL::to("/").'/static_pages/return-policy/ar',
               'terms_and_condition_url_ar' => URL::to("/").'/static_pages/terms-and-conditions/ar');
               return $links;
           
       }
}
