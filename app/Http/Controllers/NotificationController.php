<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        // Reset the user notification amount to 0
        $user->notifications = 0;
        $user->save();
        $icon = 0;
      
        $notifications = Notification::where('receiver_id', $user->id)->where('user_id', '!=', $user->id)->orderBy('created_at', 'desc')->get();

        return Inertia::render('Notifications/Index', compact('notifications', 'user', 'icon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

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
