<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;

class BookmarkResource extends JsonResource
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
            'title'   => $this->title,
            'maker_name'   => $this->maker_name,
            'bookmark_id'  => $this->bookmark_id,
            'description'   => $this->description ?? "",
            'price'    => number_format($this->price,4) ?? "",
            'size'  => $this->size,
            'quantity'  => ($this->quantity == 0 ) ? "out of stock" : $this->quantity,
            'publisher'  => new UserResource($this->users) ?? "",
            'stock_status'  => $this->stock_status,
            'book_language'    => $this->book_language ?? "",
            'image' => isset($this->image) ? url(Storage::disk('public')->url($this->image)) : "" ,
            'featured' => $this->featured,
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
