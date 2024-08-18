<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\Notification;
use Illuminate\Http\Request;

class CommentVoteController extends Controller
{
    public function upVote(Comment $comment)
    {
        $isVoted = CommentVote::where('comment_id', $comment->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === -1) {
                $isVoted->update(['vote' => 1]);
                // change back to '2' for original setting
                $comment->increment('votes', 2);

                return redirect()->back();
            } elseif ($isVoted->vote === 1) {
                return redirect()->back();
            }
        } else {
            CommentVote::create([
                'comment_id' => $comment->id,
                'user_id' => auth()->id(),
                'vote' => 1
            ]);
            $comment->increment('votes', 1);

            // Notification
            $user = auth()->user();
            $notification = Notification::create([
                'user_id' => $user->id,
                'receiver_id' => $comment->user->id,
                'type' => 'comment_vote',
                'message' => '⬆  comment on ',
                'community_slug' => $comment->post->community->slug,
                'post_slug' => $comment->post->slug,
                'post_title' => $comment->post->title,
                'event_slug' => NULL,
                'event_name' => NULL
            ]);
            if($notification->receiver_id !== $user->id ) {
                $comment->user->increment('notifications', 1);
            }
            return redirect()->back();
        }
    }

    public function downVote(Comment $comment)
    {
        $isVoted = CommentVote::where('comment_id', $comment->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === 1) {
                $isVoted->update(['vote' => -1]);
                // change back to '2' for original setting
                $comment->decrement('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === -1) {
                return redirect()->back();
            }
        } else {
            CommentVote::create([
                'comment_id' => $comment->id,
                'user_id' => auth()->id(),
                'vote' => -1
            ]);
            $comment->decrement('votes', 1);

            // Notification
            $user = auth()->user();
            Notification::create([
                'user_id' => $user->id,
                'receiver_id' => $comment->user->id,
                'type' => 'comment_vote',
                'message' => '⬇  comment on ',
                'community_slug' => $comment->post->community->slug,
                'post_slug' => $comment->post->slug,
                'post_title' => $comment->post->title,
                'event_slug' => NULL,
                'event_name' => NULL
            ]);
            $comment->user->increment('notifications', 1);

            return redirect()->back();
        }
    }
}
