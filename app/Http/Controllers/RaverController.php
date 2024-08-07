<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;
use App\Models\User;
use App\Models\Post;
use App\Models\Event;
use Inertia\Inertia;

class RaverController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     $users = User::all();

    //     return Inertia::render('Ravers/Index', compact('users'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user_id = $user->id;
        $post_count = $user->posts()->count();
        $event_count = $user->events()->count();
        $follower_count = $user->followers()->count();
        $following_count = $user->following()->count();
        $plur_points_count = $user->plur_points;
        $follower = auth()->user();

        if($follower == null) {
            $follow_check = false;
            $unfollow_check = false;
        }else{
            if ($follower->id === $user->id){
                $follow_check = false;
                $unfollow_check = false;
            }else if(!$follower->following->contains($user->id)) {
                $follow_check = true;
                $unfollow_check = false;
            }else{
                $follow_check = false;
                $unfollow_check = true;
            }
        }

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();
        if($user_id !== $id) {
            $can_update = false;
        }else {
            $can_update = true;
        }

        // $posts = Post::where('user_id', $user_id)->withCount('comments')->with('postVotes')->orderBy('votes', 'desc')->take(12)->get();

        $posts = CommunityPostResource::collection(Post::with(['user', 'community', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('user_id', $user_id)->withCount('comments')->orderBy('votes', 'desc')->paginate(20));

        // $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count', 'desc')->take(6)->get());
        // $events = Event::with('user')->where('user_id', $user_id)->latest()->get();

        return Inertia::render('Ravers/Show', compact('user', 'posts', 'post_count', 'event_count', 'follower_count', 'following_count', 'follow_check', 'unfollow_check', 'plur_points_count', 'can_update'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();
        if($id !== $user->id) {
            return Redirect::route('ravers.show', $user);
        } else {

            return Inertia::render('Ravers/Edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Only owner of user can update
        $id = Auth::id();
        if($id !== $user->id) {
            return Redirect::route('ravers.show', $user);
        }

        $user->link_one = $request->link_one;
        $user->link_two = $request->link_two;
        $user->link_three = $request->link_three;
        $user->link_four = $request->link_four;
        $user->link_five = $request->link_five;
        $user->link_six = $request->link_six;
        $user->link_seven = $request->link_seven;
        $user->link_eight = $request->link_eight;

        $user->update();

         return Redirect::route('ravers.show', $user);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function followers(String $slug)
    {
        // This is the slug user
        $user = User::where('slug', $slug)->firstOrFail();
        $user_id = $user->id;
        $post_count = $user->posts()->count();
        $event_count = $user->events()->count();
        $follower_count = $user->followers()->count();
        $following_count = $user->following()->count();
        $plur_points_count = $user->plur_points;

        // This is the current user
        $follower = auth()->user();

        // Only comparing to the logged in user and the slug
        if($follower == null) {
            $follow_check = false;
            $unfollow_check = false;
        }else{
            // check if logged in user and slug user id are the same
            if ($follower->id === $user->id){
                $follow_check = false;
                $unfollow_check = false;
            // Check if any followers of the logged in user doesn't contains the slug user id
            }else if(!$follower->following->contains($user->id)) {
                $follow_check = true;
                $unfollow_check = false;
            // not, show the follow button
            }else{
                $follow_check = false;
                $unfollow_check = true;
            }
        }

        $follower_ids = $user->followers()->pluck('follower_id');
        $follower_ids[] = $user->id;

        $followers = User::whereIn('id', $follower_ids)->where('id', '!=', $user_id)->latest()->get();

        // foreach ($followers as $sub_follower) {

      
        //    if(!$sub_follower->following->contains($user->id)) {
        //     $sub_follow_check = true;
        //     }
            // follower is the logged in user

            // if($follower == null) {
            //     $follow_check = false;
             
            // }else{
            //     if ($follower->id === $user->id){
            //         $follow_check = false;
                 
            //     }else if(!$follower->following->contains($user->id)) {
            //         $follow_check = true;
           
            //     }else{
            //         $follow_check = false;
             
            //     }
            // }


            // if($follower == null) {
            //     $sub_follow_check = false;
            // } else {
            //     if ($follower->id == $sub_follower->id) {
            //         $sub_follow_check = false;

            //     } else if(!$follower->following->contains($sub_follower->id)) {
            //         $sub_follow_check = true;

            //     }else{
            //         $sub_follow_check = false;
            //     }

            // }
        // }

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();
        if($user_id !== $id) {
            $can_update = false;
        }else {
            $can_update = true;
        }
       
        return Inertia::render('Ravers/Followers', compact('user', 'post_count', 'event_count', 'follower_count', 'following_count', 'follow_check', 'unfollow_check', 'plur_points_count', 'followers', 'can_update'));
    }

    public function following(String $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user_id = $user->id;
        $post_count = $user->posts()->count();
        $event_count = $user->events()->count();
        $follower_count = $user->followers()->count();
        $following_count = $user->following()->count();
        $follower = auth()->user();
        $plur_points_count = $user->plur_points;

        // Only comparing to the logged in user and the slug
        if($follower == null) {
            $follow_check = false;
            $unfollow_check = false;
        }else{
            // check if logged in user and slug user id are the same
            if ($follower->id === $user->id){
                $follow_check = false;
                $unfollow_check = false;
            // Check if any followers of the logged in user doesn't contains the slug user id
            }else if(!$follower->following->contains($user->id)) {
                $follow_check = true;
                $unfollow_check = false;
            // not, show the follow button
            }else{
                $follow_check = false;
                $unfollow_check = true;
            }
        }

        $following_ids = $user->following()->pluck('user_id');
        $following_ids[] = $user->id;

        $following = User::whereIn('id', $following_ids)->where('id', '!=', $user_id)->latest()->get();

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();
        if($user_id !== $id) {
            $can_update = false;
        }else {
            $can_update = true;
        }

        return Inertia::render('Ravers/Following', compact('user', 'post_count', 'event_count', 'follower_count', 'following_count', 'follow_check', 'unfollow_check', 'plur_points_count', 'following', 'can_update'));
    }

    public function events(String $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user_id = $user->id;
        $post_count = $user->posts()->count();
        $event_count = $user->events()->count();
        $follower_count = $user->followers()->count();
        $following_count = $user->following()->count();
        $follower = auth()->user();
        $plur_points_count = $user->plur_points;

        if($follower == null) {
            $follow_check = false;
            $unfollow_check = false;
        }else{
            if ($follower->id === $user->id){
                $follow_check = false;
                $unfollow_check = false;
            }else if(!$follower->following->contains($user->id)) {
                $follow_check = true;
                $unfollow_check = false;
            }else{
                $follow_check = false;
                $unfollow_check = true;
            }
        }

        $events = Event::with('user')->where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(20);

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();
        if($user_id !== $id) {
            $can_update = false;
        }else {
            $can_update = true;
        }

        return Inertia::render('Ravers/Events', compact('user', 'events', 'post_count', 'event_count', 'follower_count', 'following_count', 'follow_check', 'plur_points_count', 'unfollow_check', 'can_update'));
    }

    // public function posts(String $slug)
    // {
    //     $user = User::where('slug', $slug)->firstOrFail();
    //     $user_id = $user->id;
    //     $post_count = $user->posts()->count();
    //     $event_count = $user->events()->count();
    //     $follower_count = $user->followers()->count();
    //     $following_count = $user->following()->count();
    //     $follower = auth()->user();

    //     if($follower == null) {
    //         $follow_check = false;
    //         $unfollow_check = false;
    //     }else{
    //         if ($follower->id === $user->id){
    //             $follow_check = false;
    //             $unfollow_check = false;
    //         }else if(!$follower->following->contains($user->id)) {
    //             $follow_check = true;
    //             $unfollow_check = false;
    //         }else{
    //             $follow_check = false;
    //             $unfollow_check = true;
    //         }
    //     }

    //     return Inertia::render('Ravers/Posts', compact('user', 'post_count', 'event_count', 'follower_count', 'following_count', 'follow_check', 'unfollow_check'));
    // }
}
