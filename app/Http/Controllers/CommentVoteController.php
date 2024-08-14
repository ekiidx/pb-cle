<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentVote;
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
            return redirect()->back();
        }
    }
}
