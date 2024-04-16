<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $guarded = [];

    protected $casts = [
      'event_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventComments()
    {
        return $this->hasMany(EventComment::class);
    }

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
  
    public function getRouteKeyName()
    {
      return 'slug';
    }

    protected $appends = ['created_at_diff', 'party_date', 'weekday_format'];

    public function getCreatedAtDiffAttribute(): string 
    { 
      return $this->created_at->diffForHumans(); 
    }

    public function getPartyDateAttribute(): string
    { 
      return $this->event_date->format('M d Y'); 
    }

    // public function getPartyTimeAttribute(): string
    // { 
    //   return $this->event_time->format('h:mmA'); 
    // }

    public function getWeekdayFormatAttribute(): string
    { 
      $weekday_num = $this->event_date->format('w');
      $days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
      $weekday_format = $days[$weekday_num];

      return $weekday_format;

    }

}
