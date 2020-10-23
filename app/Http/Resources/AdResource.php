<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'image' =>isset($this->image) ? url(Storage::disk('public')->url($this->image)) : "" ,
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
