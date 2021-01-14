<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookmarkResource;
use App\Http\Resources\BookClubResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        // dd();
        return [
            'id'     => $this->id,
            'user'   => auth()->user()->first_name,
        'total_price' =>$this->total_price,
            $this->mergeWhen($this->bookmarks, [
                'bookmark' => BookmarkResource::collection($this->bookmarks),
                
            ]),
            $this->mergeWhen($this->books, [
                'book' => BookResource::collection($this->books),
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
