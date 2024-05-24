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
      'event_date' => 'date:Y-m-d',
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

    protected $appends = ['created_at_diff', 'party_date', 'weekday_format', 'month_date_format', 'day_date_format'];

    public function getCreatedAtDiffAttribute(): string 
    { 
      return $this->created_at->diffForHumans(); 
    }

    // public function getDatepickerDateAttribute

    public function getPartyDateAttribute(): string
    { 
      
      $event_date = $this->event_date;
      // $new_date = Carbon::parse($event_date)->format('M d Y);
      $new_date = $event_date->format('M d Y');

      return $new_date;
      // return $event_date;
 
    }

    public function getPartyTimeAttribute(): string
    { 
      return $this->event_time->format('h:mmA'); 
    }

    public function getDayDateFormatAttribute(): string
    {
      $event_date = $this->event_date;
      $day_date_format = $event_date->format('d');

      return $day_date_format;
    }

    public function getMonthDateFormatAttribute(): string
    {
      $event_date = $this->event_date;
 
      $month_date_format = $event_date->format('M');

      return $month_date_format;
    }

    public function getWeekdayFormatAttribute(): string
    { 
      $event_date = $this->event_date;

     $new_date = $event_date->format('D');

      return $new_date;

    }

}
