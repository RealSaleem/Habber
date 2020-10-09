<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
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
    //    dd(Storage::disk('public')->url($this->profile_pic));
        return [
            'id'     =>     $this->id,
            'first_name'   => $this->first_name,
            'last_name'   => $this->last_name,
            'email'  => $this->email,
            'phone'   => $this->phone ?? "",
            'profile_pic' =>url(Storage::disk('user_profile')->url($this->profile_pic)) ,
            'status' => $this->status
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
