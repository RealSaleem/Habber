<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\LanguageResource;

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
            'token' => $this->token ?? "",
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
