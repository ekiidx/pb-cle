<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Community;
use App\Models\PlurPoint;
use Carbon\Carbon;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostCommentController extends Controller
{
    public function store(Request $request, $community_slug, Post $post)
    {
        $request->validate([
            'content' => 'required_if:comment_image,null,|nullable',
            'comment_image' => 'required_if:content,null|max:2048|mimes:jpg,webp,png|nullable',
        ]);
        
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        if ($request->hasfile('comment_image')) {
            $comment_image_file = $request->file('comment_image');
            $comment_image_filename = $comment_image_file->getClientOriginalName();
            $comment_image_extension = $comment_image_file->getClientOriginalExtension();
            $comment_image_no_extension = explode('.' . $comment_image_extension, $comment_image_filename);

            $comment_image_slug = SlugService::createSlug(Comment::class, 'comment_image_slug', $comment_image_no_extension[0], ['unique' => true]);

            $comment_image_slug_new = $comment_image_slug . '.' . $comment_image_extension;
            
            $comment_image_file->storeAs('comment-images', $comment_image_slug_new, 'public');
            $comment->comment_image_slug = $comment_image_slug;
            $comment->comment_image = $comment_image_slug_new;
        }
        $comment->save();

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

        $request->validate([
            'content' => 'required_if:comment_image,null,|nullable',
            'comment_image' => 'required_if:content,null|max:2048|mimes:jpg,webp,png|nullable',
        ]);
    
        $comment->content = $request->content;
        
        // Store the file in storage\app\public folder if file exists in the request
        if ($request->hasfile('comment_image')) {
            $comment_image_file = $request->file('comment_image');
            $comment_image_filename = $comment_image_file->getClientOriginalName();
            $comment_image_extension = $comment_image_file->getClientOriginalExtension();
            $comment_image_no_extension = explode('.' . $comment_image_extension, $comment_image_filename);

            $comment_image_slug = SlugService::createSlug(Comment::class, 'comment_image_slug', $comment_image_no_extension[0], ['unique' => true]);

            $comment_image_slug_new = $comment_image_slug . '.' . $comment_image_extension;
            
            $comment_image_file->storeAs('comment-images', $comment_image_slug_new, 'public');
            $comment->comment_image_slug = $comment_image_slug;
            $comment->comment_image = $comment_image_slug_new;
        }
        $comment->save();

        return Redirect::route('frontend.communities.posts.show', [$community, $post]);
    }
}
