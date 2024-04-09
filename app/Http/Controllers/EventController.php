<?php

namespace App\Http\Controllers;

// use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('user')->orderBy('created_at', 'desc')->paginate(20);
        // $events_test = Event::query()->with('user')->paginate(10);
        // $events = Event::with('user')->orderby('id', 'asc')->paginate(3);
        $events_sidebar = Event::orderBy('created_at', 'desc')->take(6)->get();

        return Inertia::render('Events/Index', compact('events', 'events_sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        // Event::create($request->validated() + ['user_id' => auth()->id()]);
        // return to_route('events.index')->with('message', 'Event created successfully.')

        $validated = $request->validate([
            'name' => 'required|unique:events|max:255',
            'flyer_front_upload' => 'max:2048',
            'flyer_back_upload' => 'max:2048',
        ]);

        // Use if there's an array for the date / time input (vue3 datepicker)
        $start_time = $request->event_time;

        $event = Event::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'link_event' => $request->link_event,
            'link_tickets' => $request->link_tickets,
            'content' => $request->content,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            // 'time_start_hours' => $start_time['hours'],
            // 'time_start_minutes' => $start_time['minutes'],
        ]);

        // Store the file in storage\app\public folder if file exists in the request
        if ($request->hasfile('flyer_front_upload')) {
            $flyer_front_file = $request->file('flyer_front_upload');
            $flyer_front_file_name = $flyer_front_file->getClientOriginalName();
            $flyer_front_file_path = $flyer_front_file->storeAs('flyers', $flyer_front_file_name, 'public');

            $event->flyer_front_upload = $flyer_front_file_name;
            $event->save();
        }

        if ($request->hasfile('flyer_back_upload')) {
            $flyer_back_file = $request->file('flyer_back_upload');
            $flyer_back_file_name = $flyer_back_file->getClientOriginalName();
            $flyer_back_file_path = $flyer_back_file->storeAs('flyers', $flyer_back_file_name, 'public');

            $event->flyer_back_upload = $flyer_back_file_name;
            $event->save();
        }

        // Redirect back to the index page with a success message
        // return redirect()->route('uploads.index')
        //     ->with('success', "File `{$uploadedFile->original_name}` uploaded successfully.");
    
        return Redirect::route('events.show', $event->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $event = Event::with('User')->where('slug', $slug)->firstOrFail();

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();

        if($id !== $event->user_id) {
            $can_update = false;
            $can_delete = false;
        }else {
            $can_update = true;
            $can_delete = true;
        }

        return Inertia::render('Events/Show', compact('event', 'can_update', 'can_delete'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();

        if($id !== $event->user_id) {

            return Redirect::route('events.index');

        } else {

            return Inertia::render('Events/Edit', compact('event'));
            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();

        if($id !== $event->user_id) {

            return Redirect::route('events.index');

        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'flyer_front_upload' => 'max:2048',
                'flyer_back_upload' => 'max:2048',
            ]);
    
            $start_time = $request->event_time;
    
            $event->name = $request->name;
            $event->link_event = $request->link_event;
            $event->link_tickets = $request->link_tickets;
            $event->content = $request->content;
            $event->event_date = $request->event_date;
            // $event->time_start_hours = $start_time['hours'];
            // $event->time_start_minutes = $start_time['minutes'];
            $event->event_time = $request->event_time;
    
            // Store the file in storage\app\public folder if file exists in the request
            if ($request->hasfile('flyer_front_upload')) {
                $flyer_front_file = $request->file('flyer_front_upload');
                $flyer_front_file_name = $flyer_front_file->getClientOriginalName();
                $flyer_front_file_path = $flyer_front_file->storeAs('flyers', $flyer_front_file_name, 'public');
    
                $event->flyer_front_upload = $flyer_front_file_name;
                $event->save();
            }
    
            if ($request->hasfile('flyer_back_upload')) {
                $flyer_back_file = $request->file('flyer_back_upload');
                $flyer_back_file_name = $flyer_back_file->getClientOriginalName();
                $flyer_back_file_path = $flyer_back_file->storeAs('flyers', $flyer_back_file_name, 'public');
    
                $event->flyer_back_upload = $flyer_back_file_name;
                $event->save();
            }
    
            $event->update();
        }

        return Redirect::route('events.show', [$event->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();

        if($id !== $event->user_id) {

            return Redirect::route('events.index');

        } else {

            $event->delete();
            // return back()->with('message', 'Event deleted successfully.');
            return Redirect::route('events.index');
        }
    }
}
