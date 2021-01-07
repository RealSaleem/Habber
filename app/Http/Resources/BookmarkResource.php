<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PriceResource;

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
        // dd($this->pivot->price);
        return [
            'id'     => $this->id,
            'title'   => $this->title,
            'product_id' => optional($this->pivot)->product_id,
            'cart_quantity' => optional($this->pivot)->quantity,
            'cart_price' => optional($this->pivot)->price,
            'product_type' => 'bookmark',
            'arabic_title' => $this->arabic_title,
            'maker_name'   => $this->maker_name,
            'arabic_maker_name'   => $this->arabic_maker_name,
            'bookmark_id'  => $this->bookmark_id,
            'description'   => $this->description ?? "",
            'arabic_description'   => $this->arabic_description ?? "",
            'price'    => number_format(optional($this->product_prices[0])->price,4) ?? "",
            'prices' => PriceResource::collection($this->product_prices) ?? "",
            'size'  => $this->size,
            'quantity'  =>  $this->quantity,
            'type_of_bookmark'=> $this->type_of_bookmark ?? "",
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
