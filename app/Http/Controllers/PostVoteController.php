<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\Notification;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    public function upVote(Post $post)
    {
        $isVoted = PostVote::where('post_id', $post->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === -1) {
                $isVoted->update(['vote' => 1]);
                // change back to '2' for original setting
                $post->increment('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === 1) {
                return redirect()->back();
            }
        } else {
            PostVote::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
                'vote' => 1
            ]);
            $post->increment('votes', 1);

            // Notification
            $user = auth()->user();
            Notification::create([
                'user_id' => $user->id,
                'receiver_id' => $post->user->id,
                'type' => 'post_vote',
                'message' => '⬆  post ',
                'community_slug' => $post->community->slug,
                'post_slug' => $post->slug,
                'post_title' => $post->title,
                'event_slug' => NULL,
                'event_name' => NULL
            ]);

            if ($post->user->id !== $user->id) {
                $post->user->increment('notifications', 1);
            }
            
            return redirect()->back();
        }
    }

    public function downVote(Post $post)
    {
        $isVoted = PostVote::where('post_id', $post->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === 1) {
                $isVoted->update(['vote' => -1]);
                // change back to '2' for original setting
                $post->decrement('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === -1) {
                return redirect()->back();
            }
        } else {
            PostVote::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
                'vote' => -1
            ]);
            $post->decrement('votes', 1);

            // Notification
            $user = auth()->user();
            Notification::create([
                'user_id' => $user->id,
                'receiver_id' => $post->user->id,
                'type' => 'post_vote',
                'message' => '⬇  post ',
                'community_slug' => $post->community->slug,
                'item_slug' => $post->slug,
                'post_slug' => $post->slug,
                'post_title' => $post->title,
                'event_slug' => NULL,
                'event_name' => NULL
            ]);
            $post->user->increment('notifications', 1);

            return redirect()->back();
        }
    }
}
