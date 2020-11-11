<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;

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
            $this->mergeWhen($this->genres, [
                'genre'  => GenreResource::collection($this->genres) ?? "",
            ]),
           
            'price'    => number_format($this->product_prices->price,4) ?? "",
            'total_pages'  => $this->total_pages,
            'quantity'  => ($this->quantity == 0 ) ? "out of stock" : $this->quantity,
            'publisher'  => new UserResource($this->users) ?? "",
            'stock_status'  => $this->stock_status,
            'book_language'    => $this->book_language ?? "",
            'image' => isset($this->image) ? url(Storage::disk('public')->url($this->image)) : "" ,
            'featured' => $this->featured,
            'status' => $this->status,

            $this->mergeWhen($this->pivot, [
                'cart_quantity' => optional($this->pivot)->quantity,
                'cart_price' => number_format(optional($this->pivot)->price,4) ?? "",
                
            ]),
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
