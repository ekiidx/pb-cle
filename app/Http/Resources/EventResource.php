<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'user_slug' => $this->user->slug,
            'flyer_front' => $this->flyer_front,
            'flyer_back' => $this->flyer_back,
            'link' => $this->link,
            'party_date' => $this->party_date,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
