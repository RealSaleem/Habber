<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'price'    => $this->price ?? "",
            'size'  => $this->size,
            'quantity'  => $this->quantity,
            'business_id'  => $this->business_id,
            'stock_status'  => $this->stock_status,
            'book_language'    => $this->book_language ?? "",
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
