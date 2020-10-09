<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookmarkResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
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
            'books'  => BookResource::collection($this->books) ?? "",
            'bookmarks'  => BookmarkResource::collection($this->bookmarks) ?? "",
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
