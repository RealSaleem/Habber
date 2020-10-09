<?php

namespace App\Http\Resources;
use App\Http\Resources\BookclubResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookclubCollection extends ResourceCollection
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
            'data' => BookclubResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
               'length' => $this->collection->count(),
               'success' => true,
               'code' => Response::HTTP_OK,
               'message' => "BookClubs retrieve successfully"
            ]
        ];
    }
}
