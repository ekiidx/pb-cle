<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

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

        return back();
    }
}
