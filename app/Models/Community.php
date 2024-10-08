<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'slug'
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // public function post()
    // {
    //   return $this->belongsTo(Post::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function isActive($active)
    // {
    //    // will match routes which name starts with companies.
    //   if (request()->routeIs('companies.*')) { 
    //     $active = 'true'; 
    //   }else{ $active = 'false'; }
    // }
}
