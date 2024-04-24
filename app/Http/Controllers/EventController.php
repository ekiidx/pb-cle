<?php

namespace App\Http\Controllers;

// use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventShowResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;
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
        $events_sidebar = Event::with('user')->orderBy('created_at', 'desc')->take(6)->get();

        foreach($events_sidebar as $event) {
            // check if event post was published in the last 24 hours and if so then display "new" marker
            if($event->created_at < Carbon::now()->subDays(1)->toDateTimeString()) {
                $event->new = false;
            }else {
                $event->new = true;
            }
        }

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
        if ($request->hasfile('flyer_front')) {
            $flyer_front_file = $request->file('flyer_front');
            $flyer_front_filename = $flyer_front_file->getClientOriginalName();
            $flyer_front_extension = $flyer_front_file->getClientOriginalExtension();
            $flyer_front_no_extension = explode('.' . $flyer_front_extension, $flyer_front_filename);
            $flyer_front_slug = SlugService::createSlug(Event::class, 'flyer_front_slug', $flyer_front_no_extension[0], ['unique' => true]);

            $flyer_front_slug_new = $flyer_front_slug . '.' . $flyer_front_extension;
            
            $flyer_front_file->storeAs('flyers', $flyer_front_slug_new, 'public');
            $event->flyer_front_slug = $flyer_front_slug;
            $event->flyer_front_upload = $flyer_front_slug_new;
            $event->save();
        }

        if ($request->hasfile('flyer_back')) {
            $flyer_back_file = $request->file('flyer_back');
            $flyer_back_filename = $flyer_back_file->getClientOriginalName();
            $flyer_back_extension = $flyer_back_file->getClientOriginalExtension();
            $flyer_back_no_extension = explode('.' . $flyer_back_extension, $flyer_back_filename);
            $flyer_back_slug = SlugService::createSlug(Event::class, 'flyer_back_slug', $flyer_back_no_extension[0], ['unique' => true]);

            $flyer_back_slug_new = $flyer_back_slug . '.' . $flyer_back_extension;
            
            $flyer_back_file->storeAs('flyers', $flyer_back_slug_new, 'public');
            $event->flyer_back_slug = $flyer_back_slug;
            $event->flyer_back_upload = $flyer_back_slug_new;
            $event->save();
        }

        // Redirect back to the index page with a success message
        // return redirect()->route('uploads.index')
        //     ->with('success', "File `{$uploadedFile->original_name}` uploaded successfully.");

        // Event::create($request->validated() + ['user_id' => auth()->id()]);
        // return to_route('events.index')->with('message', 'Event created successfully.')
    
        return Redirect::route('events.show', $event->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $event_query = Event::with('user', 'eventComments')->where('slug', $slug)->firstOrFail();
        $event = new EventShowResource($event_query);

        // check if event post was published in the last 24 hours and if so then display "new" marker
        if($event->created_at < Carbon::now()->subDays(1)->toDateTimeString()) {
            $new = false;
        }else {
            $new = true;
        }

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();

        if($id !== $event->user_id) {
            $can_update = false;
            $can_delete = false;
        }else {
            $can_update = true;
            $can_delete = true;
        }

        return Inertia::render('Events/Show', compact('event', 'new', 'can_update', 'can_delete'));
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
            if ($request->hasfile('flyer_front')) {
                $flyer_front_file = $request->file('flyer_front');
                $flyer_front_filename = $flyer_front_file->getClientOriginalName();
                $flyer_front_extension = $flyer_front_file->getClientOriginalExtension();
                $flyer_front_no_extension = explode('.' . $flyer_front_extension, $flyer_front_filename);
                $flyer_front_slug = SlugService::createSlug(Event::class, 'flyer_front_slug', $flyer_front_no_extension[0], ['unique' => true]);
    
                $flyer_front_slug_new = $flyer_front_slug . '.' . $flyer_front_extension;
                
                $flyer_front_file->storeAs('flyers', $flyer_front_slug_new, 'public');
                $event->flyer_front_slug = $flyer_front_slug;
                $event->flyer_front_upload = $flyer_front_slug_new;
                $event->save();
            }
    
            if ($request->hasfile('flyer_back')) {
                $flyer_back_file = $request->file('flyer_back');
                $flyer_back_filename = $flyer_back_file->getClientOriginalName();
                $flyer_back_extension = $flyer_back_file->getClientOriginalExtension();
                $flyer_back_no_extension = explode('.' . $flyer_back_extension, $flyer_back_filename);
                $flyer_back_slug = SlugService::createSlug(Event::class, 'flyer_back_slug', $flyer_back_no_extension[0], ['unique' => true]);
    
                $flyer_back_slug_new = $flyer_back_slug . '.' . $flyer_back_extension;
                
                $flyer_back_file->storeAs('flyers', $flyer_back_slug_new, 'public');
                $event->flyer_back_slug = $flyer_back_slug;
                $event->flyer_back_upload = $flyer_back_slug_new;
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
