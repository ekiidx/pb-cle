<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use App\Models\Event;
use App\Models\User;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $posts = CommunityPostResource::collection(Post::with(['user', 'community', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments')->orderBy('id', 'desc')->take(50)->get());

        $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        $events = Event::orderBy('created_at', 'desc')->take(6)->get(['name', 'slug', 'event_date', 'created_at']);

        $users = User::orderBy('created_at', 'desc')->take(6)->get(['username', 'slug', 'profile_photo_path']);

        foreach($events as $event) {
            // check if event post was published in the last 24 hours and if so then display "new" marker
            if($event->created_at < Carbon::now()->subDays(1)->toDateTimeString()) {
                $event->new = false;
            }else {
                $event->new = true;
            }
        }

        return Inertia::render('Welcome', compact('posts', 'communities', 'events', 'users'));
    }
}
