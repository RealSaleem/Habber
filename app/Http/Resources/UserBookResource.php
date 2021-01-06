<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBookResource extends JsonResource
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
            'user_id'   =>  ($this->user_id == 0 ) ? "Guest User" : $this->user_id,
            'title'   => $this->title,
            'author_name'  => $this->author_name,
            'book_type'   => $this->book_type ?? "",
            'image' => url(Storage::disk('public')->url($this->image)) ?? "",
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
