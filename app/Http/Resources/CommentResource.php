<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'username' => $this->user->username,
            'user_slug' => $this->user->slug,
            'content' => $this->content,
            'comment_image' => $this->comment_image,
            'votes' => $this->votes,
            'commentVotes' => $this->whenLoaded('commentVotes'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
