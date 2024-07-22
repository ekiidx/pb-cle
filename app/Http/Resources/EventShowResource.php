<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventShowResource extends JsonResource
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
            'is_user' => $this->user_id,
            'user_id' => $this->user_id,
            'username' => $this->user->username,
            'user_slug' => $this->user->slug,
            'name' => $this->name,
            'slug' => $this->slug,
            'flyer_front_upload' => $this->flyer_front_upload,
            'flyer_back_upload' => $this->flyer_back_upload,
            'link_event' => $this->link_event,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'link_tickets' => $this->link_tickets,
            'time_start_hours' => $this->time_start_hours,
            'time_start_minutes' => $this->time_start_minutes,
            'time_end_hours' => $this->time_end_hours,
            'time_end_minutes' => $this->time_end_minutes,
            'content' => $this->content,
            'party_date' => $this->party_date,
            'weekday_format' => $this->weekday_format,
            'event_comments' => EventCommentResource::collection($this->whenLoaded('eventComments')),
            // 'event_genres' => EventGenreResource::collection($this->whenLoaded('genres')),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
