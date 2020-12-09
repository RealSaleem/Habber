<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;


class CountryResource extends JsonResource
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
            'iso' => $this->iso,
            'name' => $this->name,
            'city'=>$this->city_id,
            'nicename' => $this->nicename,
            'iso3' => $this->iso3,
            'phonecode' => $this->phonecode,
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
