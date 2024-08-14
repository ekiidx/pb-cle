<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostShowResource;
use App\Http\Resources\CommentResource;
use App\Models\Community;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show($comunity_slug, $slug)
    {
        $community = Community::where('slug', $comunity_slug)->firstOrFail();

        $community_post = Post::with(['postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('slug', $slug)->firstOrFail();

        $comments = Comment::with(['commentVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('post_id', $community_post->id)->get();


        $post = new PostShowResource($community_post);
       
        // Sidebar posts
        $posts = PostResource::collection($community->posts()->orderBy('votes', 'desc')->take(6)->get());

        //Only owner of post, owner of community, or admin can edit & delete
        $can_update = Auth::check() ? Auth::user()->can('update', $community_post) : false;
        $can_delete = Auth::check() ? Auth::user()->can('delete', $community_post) : false;
        $is_user = auth::id();

        // if($community_post->comment()->id = auth::id()){
        //     $can_update_comment = true;
        // }
       

        // if($user_id !== $comment->id) {
        //     $can_update_comment = false;
        // }else {
        //     $can_update_comment = true;
        // };

        return Inertia::render('Frontend/Posts/Show', compact('community', 'post', 'posts', 'can_update', 'can_delete', 'is_user', 'comments'));
    }
}
