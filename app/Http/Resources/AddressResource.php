<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'address_name' => $this->name,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'country' => $this->country,
            'city' => $this->city,
            'state' => $this->state,
            'post_code' => $this->post_code,
            'user_id' => $this->address_line2,
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
