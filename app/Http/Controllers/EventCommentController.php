<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PlurPoint;
use App\Models\EventComment;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventCommentController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $event->eventComments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        // PLUR Points
        $user = auth()->user();
        PlurPoint::create([
            'user_id' => $user->id,
            'action' => 'event_comment',
            'points' => 1
        ]);
        $user->increment('plur_points', 1);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, $id)
    {
        $comment = EventComment::where('id', $id)->firstOrFail();

        // Only owner of comment or admin can edit & delete
        $user_id = Auth::id();
        if($user_id !== $comment->user_id) {
            return Redirect::route('events.show', [$event]);
        }

        return Inertia::render('EventComments/Edit', compact('comment', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event, $id)
    {
        $comment = EventComment::where('id', $id)->firstOrFail();

        // Only owner of comment or admin can edit & delete
        $user_id = Auth::id();
        if($user_id !== $comment->user_id) {
            return Redirect::route('events.show', [$event]);
        }
    
        $comment->content = $request->content;
        $comment->save();

        return Redirect::route('events.show', [$event]);
    }
}
