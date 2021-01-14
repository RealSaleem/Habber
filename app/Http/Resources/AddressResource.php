<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;

class AddressResource extends JsonResource
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
            'id' => $this->id,
            'address_name' => $this->address_name,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'country_id' =>  optional($this->countries)->id,
            'city_id' => optional($this->cities)->id,
            'phone' => $this->phone,
            'state' => $this->state,
            'post_code' => $this->post_code,
            'user_id' => $this->user_id,
            'shipping_charges'=> optional($this->cities)->shipping_charges*auth()->user()->currencies->rate,4
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
