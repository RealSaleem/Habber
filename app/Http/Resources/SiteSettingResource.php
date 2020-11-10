<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
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
            'email'   => $this->email,
            'phone_no'   => $this->phone_no,
            'whatsaap_number'  => $this->whatsaap_number,
            'twitter_url'   => $this->twitter_url ?? "",
            'facebook_url'   => $this->facebook_url ?? "",
            'instagram_url'   => $this->instagram_url ?? "",
            'snapchat_url'   => $this->snapchat_url ?? "",
            'language'  => $this->languages->name ?? "",
            'currency'  => $this->currencies->name ?? "",
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
