<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        return back();
    }
}
