<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookmarkResource;
use App\Http\Resources\BookClubResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // (isset($this->books)) ? BookResource::collection($this->books) : (isset($this->bookmarks)) ? BookmarkResource::collection($this->bookmarks) : (isset($this->bookclubs)) ?
        // dd($this->bookclubs);
        return  [
            'id'     => $this->id,
            'description'   => $this->description ?? "",
            'banner_image' =>isset($this->image) ? url(Storage::disk('public')->url($this->image)) : "" ,
            'order' => $this->sort_order,
            'banner_link'=>$this->banner_link,
            $this->mergeWhen($this->bookclubs, [
                'product' => new BookClubResource($this->bookclubs),
            ]),
            $this->mergeWhen($this->bookmarks, [
                'product' => new BookmarkResource($this->bookmarks),
            ]),
            $this->mergeWhen($this->books, [
                'product' => new BookResource($this->books),
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
