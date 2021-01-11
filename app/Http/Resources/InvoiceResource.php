<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'id'  => $this->id,
            'order_date'=>$this->created_at,
            'user'   => auth()->user()->first_name,
            'phone_no' => auth()->user()->phone,
            'address'=>$this->addresses->address_name,
            'currency_iso'=> $this->currencies->iso,
            'payment_method'=>$this->payment_type == 'online' ? 1: 0,
            $this->mergeWhen($this->bookmarks, [
                'bookmarks' => BookmarkResource::collection($this->bookmarks),
    
            ]),
            $this->mergeWhen($this->books, [
                'books' => BookResource::collection($this->books),
            ]),
           'price'=> $this->total_price,
           'quantity' => $this->total_quantity,
           'total_price' => $this->total_quantity * $this->total_price,
      
      
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

