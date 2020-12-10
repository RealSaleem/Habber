<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BookResource;

class BookClubResource extends JsonResource
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
            'name'   => $this->name,
            'arabic_name' => $this->arabic_name,
            'product_type' => 'bookclub',
            'image'  => isset($this->banner_image) ? url(Storage::disk('public')->url($this->banner_image)) : "" ,
            'book'  => (new BookResource($this->books)) ?? ""
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
