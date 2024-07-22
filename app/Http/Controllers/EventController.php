<?php

namespace App\Http\Controllers;

// use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Genre;
use App\Models\PlurPoint;
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
        $events = Event::with('user')->orderBy('created_at', 'desc')->paginate(20)->onEachSide(1);
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
        // TODO: implement later and use table
        // TODO: this can be optimazed to only pull the name and id
        // $genres = Genre::all();
        // foreach( $genres as $genre ) {
        //     $name = $genre->name;
        //     $id = $genre->id;

        //     $genre_options[] = 
        //         array('label' => $name, 'value' => $id
        //     );
        // }

        return Inertia::render('Events/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|unique:events|max:255',
            'flyer_front' => 'max:2048',
            'flyer_back' => 'max:2048',
            'event_date' => 'required',
        ]);

        // TODO: genres options
        // $genres = $request->genre_values;
        // // $new_genres = implode(',', $genres);    
        // $collection = collect([
        //     $genres
        // ]);
        // $collection->implode(', ');
        // $data = json_encode($request->genre_values);
        // foreach( $genres as $genre ) {
        //     $event->genres()->create([
        //         'event_id' => $event->id,
        //         'genre_id' => $genre["value"],
        //         'label' => $genre["label"]
        //     ]);
        // }
        // // $count_length = count($genres);
        // if ($genres) {
        //     foreach( $genres as $genre ) {
        //     $new_genre = [];
        //     $new_genre["genre_id"] = $genre["value"];
        //     $new_genre["label"] = $genre["label"];
        //     $event->genres()->attach($event, $new_genre);
        //     }
        // }

        // TODO: flyer_front and flyer_back being empty makes $genres have [], with an image upload it changes $genres to NULL
        $genres = $request->genre_values;
        if( $genres != NULL ) {
            $count = count($genres);
        } else {
            $genres = NULL;
        }

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
            'event_genres' => $genres
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
        }
        $event->save();
        // Redirect back to the index page with a success message
        // return redirect()->route('uploads.index')
        //     ->with('success', "File `{$uploadedFile->original_name}` uploaded successfully.");

        // Event::create($request->validated() + ['user_id' => auth()->id()]);
        // return to_route('events.index')->with('message', 'Event created successfully.')

        // PLUR Points
        $user = auth()->user();
        PlurPoint::create([
            'user_id' => $user->id,
            'action' => 'event',
            'points' => 10
        ]);
        $user->increment('plur_points', 10);
    
        return Redirect::route('events.show', $event->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $event_query = Event::with('user', 'eventComments')->where('slug', $slug)->firstOrFail();
        $event = new EventShowResource($event_query);

        $genres = $event->event_genres;

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
        $is_user = auth::id();

        return Inertia::render('Events/Show', compact('event', 'genres', 'new', 'can_update', 'can_delete', 'is_user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();
        if($id !== $event->user_id) {
            return Redirect::route('events.index');
        }
        $genres = $event->event_genres;
        // $new_date = $event->event_date->format('m-d-Y');
        // $new_date = Carbon::parse($event->event_date)->format('Y/m/d');
        // dd($new_date);
        // $new_date = '2024-05-25';

        // TODO: This can be optimized like the one above in this file
        // TODO: implement later and use table
        // $genres = Genre::all();
        // foreach( $genres as $genre ) {
        //     $name = $genre->name;
        //     $id = $genre->id;
        //     $genre_options[] = 
        //         array('label' => $name, 'value' => $id
        //     );
        // }
        // if ($event_genres) {
        //     foreach ($event_genres as $event_genre) {
        //         $name = $event_genre->name;
        //         $id = $event_genre->pivot_genre_id;
        //         $genre_values[] = 
        //             array('label' => $name, 'value' => $id);
        //     } 
        // }

        return Inertia::render('Events/Edit', compact('event', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //Only owner of event can update
        $id = Auth::id();
        if($id !== $event->user_id) {
            return Redirect::route('events.index');
        }
        $validated = $request->validate([
            'name' => 'required|max:255',
            'flyer_front' => 'max:2048',
            'flyer_back' => 'max:2048',
            'event_date' => 'required',
        ]);
    
        $event->name = $request->name;
        $event->link_event = $request->link_event;
        $event->link_tickets = $request->link_tickets;
        $event->content = $request->content;
        // $event->event_date = $request->event_date;
        // $event->time_start_hours = $start_time['hours'];
        // $event->time_start_minutes = $start_time['minutes'];
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;

        // TODO: flyer_front and flyer_back being empty makes $genres have [], with an image upload it changes $genres to NULL
        $genres = $request->genre_values;
        if( $genres != NULL ) {
            $count = count($genres);
        } else {
            $genres = NULL;
        }
        $event->event_genres = $genres;
    
        // TODO: Genre options
        // $genres = $request->genre_values;
        // if ($genres) {
        //     foreach( $genres as $genre ) {
        //         // dd($genre["value"]);
        //         // $id = $genre->value; 
        //         // dd($id);
        //         $event->genres()->sync($genres);
        //     }
        // }else {
        //         $genres = [];
        // }
        //     $genres = $request->genre_values;
        //     // dd($genres);
        //     // if ($genres) {
        //     foreach ($data->genres as $genre) {
        //     $event->genres()->sync($genres['id'] => );
        // }
        //   for ($row = 0; $row < count($genres); $row++ ) {
        //   }
        //    foreach( $genres as $genre ) {
        //     $event->genres()->sync(
        //         $genre["id"]
        //     );
        //    }
        // //        
        //     }
        //     }else {
        //         $event->genres()->sync($genres);
        //     }
        
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
        }
        $event->save();

        return Redirect::route('events.show', [$event->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //Only owner of event can delete
        $id = Auth::id();
        if($id !== $event->user_id) {
            return Redirect::route('events.index');
        }
        
        $event->delete();
        // return back()->with('message', 'Event deleted successfully.');
        return Redirect::route('events.index');
    }
}
