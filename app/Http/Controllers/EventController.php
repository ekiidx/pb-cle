<?php

namespace App\Http\Controllers;

// use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('user')->get();

        return Inertia::render('Events/Index', compact('events'));
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

        // Store the file in storage\app\public folder
        $flyer_front_file = $request->file('flyer_front_upload');
        $flyer_back_file = $request->file('flyer_back_upload');

        $flyer_front_file_name = $flyer_front_file->getClientOriginalName();
        $flyer_back_file_name = $flyer_back_file->getClientOriginalName();
        
        $flyer_front_file_path = $flyer_front_file->storeAs('flyers', $flyer_front_file_name, 'public');
        $flyer_back_file_path = $flyer_back_file->storeAs('flyers', $flyer_back_file_name, 'public');
        
        $event = Event::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'link_event' => $request->link_event,
            'link_tickets' => $request->link_tickets,
            'content' => $request->content,
            'event_date' => $request->event_date,
            'time_start_hours' => $start_time['hours'],
            'time_start_minutes' => $start_time['minutes'],
            'flyer_front_upload' => $flyer_front_file_name,
            'flyer_back_upload' => $flyer_back_file_name,
        ]);

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

        return Inertia::render('Events/Show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
