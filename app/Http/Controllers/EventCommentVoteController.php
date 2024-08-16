<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventComment;
use App\Models\EventCommentVote;
use Illuminate\Http\Request;

class EventCommentVoteController extends Controller
{
    public function upVote(EventComment $eventComment)
    {
        $isVoted = EventCommentVote::where('event_comment_id', $eventComment->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === -1) {
                $isVoted->update(['vote' => 1]);
                // change back to '2' for original setting
                $eventComment->increment('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === 1) {
                return redirect()->back();
            }
        } else {
            EventCommentVote::create([
                'event_comment_id' => $eventComment->id,
                'user_id' => auth()->id(),
                'vote' => 1
            ]);
            $eventComment->increment('votes', 1);
            return redirect()->back();
        }
    }

    public function downVote(EventComment $eventComment)
    {
        $isVoted = EventCommentVote::where('event_comment_id', $eventComment->id)->where('user_id', auth()->id())->first();

        if (!is_null($isVoted)) {
            if ($isVoted->vote === 1) {
                $isVoted->update(['vote' => -1]);
                // change back to '2' for original setting
                $eventComment->decrement('votes', 2);
                return redirect()->back();
            } elseif ($isVoted->vote === -1) {
                return redirect()->back();
            }
        } else {
           EventCommentVote::create([
                'event_comment_id' => $eventComment->id,
                'user_id' => auth()->id(),
                'vote' => -1
            ]);
            $eventComment->decrement('votes', 1);
            return redirect()->back();
        }
    }
}
