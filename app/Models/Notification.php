<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'receiver_id',
        'type',
        'message',
        'community_slug',
        'post_slug',
        'post_title',
        'event_slug',
        'event_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post() 
    {
        return $this->belongsTo(Post::class);
    }

    protected $appends = ['created_at_diff', 'username'];

    public function getCreatedAtDiffAttribute(): string 
    { 
        return $this->created_at->diffForHumans();
    }

    public function getUsernameAttribute(): string
    {
        if($this->user->username) 
        {
            return $this->user->username;
        }
    }
}
