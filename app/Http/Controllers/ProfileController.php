<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return Inertia::render('Profiles/Index', compact('users'));
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
    public function show(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        // $user_id = $user->id;

        // $posts = Post::where('user_id', $id)->withCount('comments')->with('postVotes')->orderBy('votes', 'desc')->take(12)->get();

        $posts = CommunityPostResource::collection(Post::with(['user', 'community', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('user_id', $id)->withCount('comments')->orderBy('votes', 'desc')->take(4)->get());

        // $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        return Inertia::render('Profiles/Show', compact('user', 'posts'));
        
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
