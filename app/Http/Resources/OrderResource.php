<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookmarkResource;
use App\Http\Resources\BookClubResource;
use Illuminate\Support\Facades\URL;

class OrderResource extends JsonResource
 { //  
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
            //'user'   => auth()->user()->first_name,
            'total_price' =>  number_format($this->total_price + $this->addresses->countries['shipping_charges'] * auth()->user()->currencies->rate,4),
            'status' => $this->status,
//            (
//                ($this->status == 0) ? "Confirmed" :
//                 (($this->status == 1) ? "Shipped" :
//                  (($this->status == 2) ? "Delivered" : $this->status))),
                  
            'total_quantity' => $this->total_quantity,
            'address_name' => $this->addresses['address_name'],
            'phone' => $this->addresses['phone'],
            'currency_iso'=> $this->currencies->iso,
            'payment_type'=>$this->payment_type,
            'payment_success_url'=>URL::to("/").'/payment/success/?id='.$this->id.'&user_id='.auth()->user()->id,
            'payment_failure_url'=>URL::to("/").'/payment/failure/?id='.$this->id,
            'navigation' => $this->payment_type == 'online' ? 1 : 0,
            'shipping_charges'=>  $this->addresses->countries['shipping_charges']*auth()->user()->currencies->rate,
            'created_at'=> $this->created_at,
            $this->mergeWhen($this->bookmarks, [
                'bookmarks' => BookmarkResource::collection($this->bookmarks),
                
            ]),
            $this->mergeWhen($this->books, [
                'books' => BookResource::collection($this->books),
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
