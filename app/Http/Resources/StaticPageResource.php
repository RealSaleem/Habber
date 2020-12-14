<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\URL;

class StaticPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
           'title' => $this->title,
           'slug' => $this->url,
            'description' => $this->description,
            'about_us_url' => URL::to("/").'/static_pages/about-us',
            'privacy_policy_url' => URL::to("/").'/static_pages/privacy-policy',
            'return_policy_url' => URL::to("/").'/static_pages/return-policy',
            'terms_and_condition_url' => URL::to("/").'/static_pages/terms-and-conditions'
            
        ];
    }
    public function with($request)
    {
        return [
            'success' => true,
            'code' => Response::HTTP_OK
        ];
    }
}
