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

    protected $appends = ['created_at_diff', 'event_date', 'weekday_format'];

    public function getCreatedAtDiffAttribute(): string 
    { 
      return $this->created_at->diffForHumans(); 
    }

    public function getEventDateAttribute(): string 
    { 
      return $this->created_at->format('M d Y'); 
    }

    public function getWeekdayFormatAttribute(): string
    { 
      $weekday_num = $this->created_at->format('w');
      $days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
      $weekday_format = $days[$weekday_num];

      return $weekday_format;

    }

}
