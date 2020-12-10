<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CityResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CityResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
               'length' => $this->collection->count(),
               'success' => true,
               'code' => Response::HTTP_OK,
               'message' => "Cities retrieve successfully"
            ]
        ];
    }
}

