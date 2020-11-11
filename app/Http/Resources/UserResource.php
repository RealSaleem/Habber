<?php

namespace App\Http\Resources;
use App\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
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
            'id'     =>     $this->id,
            'first_name'   => $this->first_name,
            'last_name'   => $this->last_name,
            'email'  => $this->email,
            'phone'   => $this->phone ?? "",
            'profile_pic' => isset($this->profile_pic) ? url(Storage::disk('user_profile')->url($this->profile_pic)) : "" ,
            'status' => $this->status,
            'language'  => new LanguageResource(optional($this->languages)),
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
