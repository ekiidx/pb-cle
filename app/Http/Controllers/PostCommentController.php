<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Community;
use App\Models\PlurPoint;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostCommentController extends Controller
{
    public function store(Request $request, $community_slug, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);
        
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        // PLUR Points
        $user = auth()->user();
        PlurPoint::create([
            'user_id' => $user->id,
            'action' => 'post_comment',
            'points' => 1
        ]);
        $user->increment('plur_points', 1);

        return back();
    }

    //     /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function show($community_slug, Post $post, Comment $comment)
    // {
    //     return Inertia::render('Comments/Edit');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community, Post $post, $id)
    {
        $comment = Comment::where('id', $id)->firstOrFail();

        // Only owner of comment or admin can edit & delete
        $user_id = Auth::id();
        if($user_id !== $comment->user_id) {
            return Redirect::route('frontend.communities.posts.show', [$community, $post]);
        }

        return Inertia::render('Comments/Edit', compact('comment', 'community', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Community $community, Post $post, $id)
    {
        $comment = Comment::where('id', $id)->firstOrFail();

        // Only owner of comment or admin can edit & delete
        $user_id = Auth::id();
        if($user_id !== $comment->user_id) {
            return Redirect::route('frontend.communities.posts.show', [$community, $post]);
        }
    
        $comment->content = $request->content;
        $comment->save();

        return Redirect::route('frontend.communities.posts.show', [$community, $post]);
    }
}
