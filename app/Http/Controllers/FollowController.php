<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, User $user){
        $follower = auth()->user();

        if ($follower->following->contains($user->id) || $follower->id === $user->id){
            return redirect()->back();
        }else{
            $follower->following()->attach($user);
        }
        
        return redirect()->back();
    }

    public function unfollow(Request $request, User $user){
        $follower = auth()->user();

        if (!$follower->following->contains($user->id) || $follower->id === $user->id){
            return redirect()->back();
        }else{
            $follower->following()->detach($user);
        }

        return redirect()->back();
    }
}
