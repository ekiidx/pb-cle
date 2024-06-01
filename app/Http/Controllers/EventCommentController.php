<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PlurPoint;
use Illuminate\Http\Request;

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
}
