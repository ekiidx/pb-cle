<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory, Sluggable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }
  
    public function getRouteKeyName()
    {
      return 'slug';
    }

    protected $appends = ['created_at_diff'];

    public function getCreatedAtDiffAttribute(): string 
    { 
      return $this->created_at->diffForHumans(); 
    }
}
