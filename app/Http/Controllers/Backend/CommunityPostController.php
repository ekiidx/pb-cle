<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PlurPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class CommunityPostController extends Controller
{
    public function create(Community $community)
    {
        return Inertia::render('Communities/Posts/Create', compact('community')); //
    }

    public function store(StorePostRequest $request, Community $community)
    {
        $post = $community->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        if ($request->hasfile('post_image')) {
            $post_image_file = $request->file('post_image');
            $post_image_filename = $post_image_file->getClientOriginalName();
            $post_image_extension = $post_image_file->getClientOriginalExtension();
            $post_image_no_extension = explode('.' . $post_image_extension, $post_image_filename);
            $post_image_slug = SlugService::createSlug(Post::class, 'post_image_slug', $post_image_no_extension[0], ['unique' => true]);

            $post_image_slug_new = $post_image_slug . '.' . $post_image_extension;
            
            $post_image_file->storeAs('post-images', $post_image_slug_new, 'public');
            $post->post_image_slug = $post_image_slug;
            $post->post_image = $post_image_slug_new;
            $post->save();
        }

        // PLUR Points
        $user = auth()->user();
        PlurPoint::create([
            'user_id' => $user->id,
            'action' => 'post',
            'points' => 5
        ]);
        $user->increment('plur_points', 5);

        return Redirect::route('frontend.communities.show', $community->slug);
    }

    public function edit(Community $community, Post $post)
    {
        $this->authorize('update', $post);
        return Inertia::render('Communities/Posts/Edit', compact('community', 'post'));
    }

    public function update(Request $request, Community $community, Post $post)
    {
        // $this->authorize('update', $post);
        // $post->update($request->validated());

        //Only owner of post, owner of event, or admin can edit & delete
        $id = Auth::id();

        if($id !== $post->user_id)  {

            return Redirect::route('frontend.communities.show');

        } else {
            $validated = $request->validate([
                'title' => ['min:5'],
                'url' => ['nullable', 'url'],
                'description' => ['nullable', 'min:10'],
                'post_image' => ['nullable', 'max:2048'],
            ]);

            // if ($request->title) {
            //     $post->title = $request->title;
            // }
            $post->title = $request->title;
            $post->url = $request->url;
            $post->description = $request->description;

            if ($request->hasfile('post_image')) {
              
                $post_image_file = $request->file('post_image');
                $post_image_filename = $post_image_file->getClientOriginalName();
                $post_image_extension = $post_image_file->getClientOriginalExtension();
                $post_image_no_extension = explode('.' . $post_image_extension, $post_image_filename);
                $post_image_slug = SlugService::createSlug(Post::class, 'post_image_slug', $post_image_no_extension[0], ['unique' => true]);
    
                $post_image_slug_new = $post_image_slug . '.' . $post_image_extension;
               
                $post_image_file->storeAs('post-images', $post_image_slug_new, 'public');
                $post->post_image_slug = $post_image_slug;
                $post->post_image = $post_image_slug_new;
            }

            $post->save();
        }

        return Redirect::route('frontend.communities.posts.show', [$community->slug, $post->slug]);
    }

    public function destroy(Community $community, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return Redirect::route('frontend.communities.show', $community->slug);
    }
}
