<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PlurPoint;
use App\Models\EventComment;
use App\Models\Comment;
use App\Models\Notification;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventCommentController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'content' => 'required_if:comment_image,null,|nullable',
            'comment_image' => 'required_if:content,null|max:2048|mimes:jpg,webp,png|nullable',
        ]);

        // $request->validate([
        //     'content' => 'nullable', 'min:1',
        //     'comment_image' => 'nullable', 'max:2048'
        // ]);

        $comment = $event->eventComments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        if ($request->hasfile('comment_image')) {
            $comment_image_file = $request->file('comment_image');
            $comment_image_filename = $comment_image_file->getClientOriginalName();
            $comment_image_extension = $comment_image_file->getClientOriginalExtension();
            $comment_image_no_extension = explode('.' . $comment_image_extension, $comment_image_filename);

            $comment_image_slug = SlugService::createSlug(EventComment::class, 'comment_image_slug', $comment_image_no_extension[0], ['unique' => true]);

            $comment_image_slug_new = $comment_image_slug . '.' . $comment_image_extension;
            
            $comment_image_file->storeAs('comment-images', $comment_image_slug_new, 'public');
            $comment->comment_image_slug = $comment_image_slug;
            $comment->comment_image = $comment_image_slug_new;
        }
        $comment->save();

        // PLUR Points
        $user = auth()->user();
        PlurPoint::create([
            'user_id' => $user->id,
            'action' => 'event_comment',
            'points' => 1
        ]);
        $user->increment('plur_points', 1);

        // Notification
        Notification::create([
            'user_id' => $user->id,
            'receiver_id' => $event->user->id,
            'type' => 'event_comment',
            'message' => '💬  on ',
            'community_slug' => NULL,
            'post_slug' => NULL,
            'post_title' => NULL,
            'event_slug' => $event->slug,
            'event_name' => $event->name
        ]);
        $event->user->increment('notifications', 1);

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

        $request->validate([
            'content' => 'nullable',
            'comment_image' => 'required_if:content,null', 'nullable', 'max:2048'
        ]);
    
        $comment->content = $request->content;

        // Store the file in storage\app\public folder if file exists in the request
        if ($request->hasfile('comment_image')) {
            $comment_image_file = $request->file('comment_image');
            $comment_image_filename = $comment_image_file->getClientOriginalName();
            $comment_image_extension = $comment_image_file->getClientOriginalExtension();
            $comment_image_no_extension = explode('.' . $comment_image_extension, $comment_image_filename);

            $comment_image_slug = SlugService::createSlug(EventComment::class, 'comment_image_slug', $comment_image_no_extension[0], ['unique' => true]);

            $comment_image_slug_new = $comment_image_slug . '.' . $comment_image_extension;
            
            $comment_image_file->storeAs('comment-images', $comment_image_slug_new, 'public');
            $comment->comment_image_slug = $comment_image_slug;
            $comment->comment_image = $comment_image_slug_new;
        }
        $comment->save();

        return Redirect::route('events.show', [$event]);
    }
}
