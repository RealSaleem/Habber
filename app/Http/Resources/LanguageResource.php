<?php

namespace App\Http\Resources;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status
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
