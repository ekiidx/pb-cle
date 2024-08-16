<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCommentVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_comment_id',
        'vote'
    ];
}