<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use App\Models\Event;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $posts = CommunityPostResource::collection(Post::with(['user', 'community', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments')->orderBy('id', 'desc')->take(20)->get());

        $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        $events = Event::all();

        return Inertia::render('Welcome', compact('posts', 'communities', 'events'));
    }
}
