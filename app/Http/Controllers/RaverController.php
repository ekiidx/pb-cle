<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\User;
use App\Models\Post;
use App\Models\Event;
use Inertia\Inertia;

class RaverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return Inertia::render('Ravers/Index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user_id = $user->id;

        // $posts = Post::where('user_id', $user_id)->withCount('comments')->with('postVotes')->orderBy('votes', 'desc')->take(12)->get();

        $posts = CommunityPostResource::collection(Post::with(['user', 'community', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('user_id', $user_id)->withCount('comments')->orderBy('votes', 'desc')->take(4)->get());

        // $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        $events = Event::with('user')->where('user_id', $user_id)->latest()->get();

        return Inertia::render('Ravers/Show', compact('user', 'posts', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
