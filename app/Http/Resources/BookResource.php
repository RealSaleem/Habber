<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'author_name'   => $this->author_name,
            'isbn'  => $this->isbn,
            'description'   => $this->description ?? "",
            'cover_type'    => $this->cover_type ?? "",
            'genre'  => $this->genres,
            'price'    => $this->price ?? "",
            'total_pages'  => $this->total_pages,
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
