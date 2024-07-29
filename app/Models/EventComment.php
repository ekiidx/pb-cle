<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class EventComment extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'event_id',
        'content'
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

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // protected $appends = ['created_at_diff'];

    // public function getCreatedAtDiffAttribute(): string 
    // { 
    //   return $this->created_at->diffForHumans(); 
    // }
}
