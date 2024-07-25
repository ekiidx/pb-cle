<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityStoreRequest;
use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use App\Models\PlurPoint;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if raver has 100 plur points
        $user = auth()->user();
        if($user->plur_points >= 100) {
            $can_create_community = true;
        }else {
            $can_create_community = false;
        }
        
        // $communities = Community::where('user_id', auth()->id())->paginate(5)->through(fn ($community) => [
        $communities_index = Community::latest()->paginate(20)->through(fn ($community) => [
            'id' => $community->id,
            'name' => $community->name,
            'slug' => $community->slug,
        ]);

        $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        return Inertia::render('Communities/Index', compact('communities_index', 'communities', 'can_create_community'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Communities/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityStoreRequest $request, Community $community)
    {
        // Community::create($request->validated() + ['user_id' => auth()->id()]);
        // return to_route('communities.index')->with('message', 'Community created successfully.');

        // Check if raver has 100 plur points
        $user = auth()->user();
        if($user->plur_points >= 100) {

            $community = Community::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'description' => $request->description,
            ]);
    
            // PLUR Points
            $user = auth()->user();
            PlurPoint::create([
                'user_id' => $user->id,
                'action' => 'create_community',
                'points' => 100
            ]);
            $user->decrement('plur_points', 100);

            return Redirect::route('frontend.communities.show', [$community->slug]);
        
        }else {
            return to_route('communities.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $community = Community::where('slug', $slug)->firstOrFail();
        $posts = CommunityPostResource::collection($community->posts()->with(['user', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments')->orderBy('id', 'desc')->paginate(20));

        $communities = CommunityResource::collection(Community::withCount('posts')->latest()->take(5)->get());

        return Inertia::render('Frontend/Communities/Show', compact('community', 'posts', 'communities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        // $this->authorize('update', $community);
        // return Inertia::render('Communities/Edit', compact('community'));

        return to_route('communities.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommunityStoreRequest $request, Community $community)
    {
        // $this->authorize('update', $community);
        // $community->update($request->validated());

        // return to_route('communities.index')->with('message', 'Community updated successfully.');

        return to_route('communities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        // $this->authorize('delete', $community);
        // $community->delete();
        // return back()->with('message', 'Community deleted successfully.');

        return to_route('communities.index');
    }
}
