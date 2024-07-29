<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Comment extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'created_at',
        'updated_at'
    ];

    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'name',
          'separator' => '-',
          'unique' => true,
        ],
      ];
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // protected $appends = ['created_at_diff'];

    // public function getCreatedAtDiffAttribute(): string 
    // { 
    //     return $this->created_at->diffForHumans();
    // }
}