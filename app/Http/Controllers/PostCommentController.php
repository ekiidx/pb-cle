<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PlurPoint;
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
}
