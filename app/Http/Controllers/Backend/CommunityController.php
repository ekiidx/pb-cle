<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityStoreRequest;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
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
            // $communities = Community::where('user_id', auth()->id())->paginate(5)->through(fn ($community) => [
            $communities_index = Community::latest()->paginate(20)->through(fn ($community) => [
            'id' => $community->id,
            'name' => $community->name,
            'slug' => $community->slug,
        ]);

        $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());

        return Inertia::render('Communities/Index', compact('communities_index', 'communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Inertia::render('Communities/Create');
        return to_route('communities.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityStoreRequest $request)
    {
        // Community::create($request->validated() + ['user_id' => auth()->id()]);
        // return to_route('communities.index')->with('message', 'Community created successfully.');

        return to_route('communities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return to_route('communities.index');
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
