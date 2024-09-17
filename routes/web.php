<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PlurPointController;
use App\Http\Controllers\RaverController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCommentController;
use App\Http\Controllers\CommentVoteController;
use App\Http\Controllers\EventCommentVoteController;
use App\Http\Controllers\NotificationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// About
// Route::inertia('/about', 'About');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

Route::group(['middleware' => ['auth', 'verified']], function () {
    
    // Communities
    Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
    Route::get('/communities/create', [CommunityController::class, 'create'])->name('communities.create');
    Route::post('/communities', [CommunityController::class, 'store'])->name('communities.store');
    Route::get('/communities/{community:slug}', [CommunityController::class, 'show'])->name('communities.show');

    // Voting
    Route::post('/posts/{post:slug}/upVote', [PostVoteController::class, 'upVote'])->name('posts.upVote');
    Route::post('/posts/{post:slug}/downVote', [PostVoteController::class, 'downVote'])->name('posts.downVote');
    Route::post('/comments/{comment:id}/upVote', [CommentVoteController::class, 'upVote'])->name('comments.upVote');
    Route::post('/comments/{comment:id}/downVote', [CommentVoteController::class, 'downVote'])->name('comments.downVote');
    Route::post('/event-comment/{eventComment:id}/upVote', [EventCommentVoteController::class, 'upVote'])->name('eventComments.upVote');
    Route::post('/event-comment/{eventComment:id}/downVote', [EventCommentVoteController::class, 'downVote'])->name('eventComments.downVote');

    // Posts
    Route::get('/communities/{community:slug}/posts/create', [CommunityPostController::class, 'create'])->name('communities.posts.create');
    Route::post('/communities/{community:slug}/posts', [CommunityPostController::class, 'store'])->name('communities.posts.store');
    Route::get('/communities/{community:slug}/posts/{post:slug}', [PostController::class, 'show'])->name('communities.posts.show');
    Route::get('/communities/{community:slug}/posts/{post:slug}/edit', [CommunityPostController::class, 'edit'])->name('communities.posts.edit');
    Route::post('/communities/{community:slug}/posts/{post:slug}', [CommunityPostController::class, 'update'])->name('communities.posts.update');
    Route::delete('/communities/{community:slug}/posts/{post:slug}', [CommunityPostController::class, 'destroy'])->name('communities.posts.destroy');
    Route::post('/communities/{community:slug}/posts/{post:slug}/comments', [PostCommentController::class, 'store'])->name('posts.comments');
    Route::get('/communities/{community:slug}/posts/{post:slug}/comments/{id}/edit', [PostCommentController::class, 'edit'])->name('posts.comments.edit');
    Route::post('/communities/{community:slug}/posts/{post:slug}/comments/{id}', [PostCommentController::class, 'update'])->name('posts.comments.update');

    // Ravers
    Route::get('/ravers/{user:slug}/edit', [RaverController::class, 'edit'])->name('ravers.edit');
    Route::post('/ravers/{user:slug}/update', [RaverController::class, 'update'])->name('ravers.update');

    // Events
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event:slug}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::post('/events/{event:slug}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event:slug}/destroy', [EventController::class, 'destroy'])->name('events.destroy');
    Route::post('/events/{event:slug}/comments', [EventCommentController::class, 'store'])->name('events.comments');
    Route::get('/events/{event:slug}/comments/{id}/edit', [EventCommentController::class, 'edit'])->name('events.comments.edit');
    Route::post('/events/{event:slug}/comments/{id}', [EventCommentController::class, 'update'])->name('events.comments.update');

    // Follow
    Route::post('/ravers/{user:slug}/follow', [FollowController::class, 'follow'])->name('ravers.follow');
    Route::post('/ravers/{user:slug}/unfollow', [FollowController::class, 'unfollow'])->name('ravers.unfollow');

    // Notifications
    Route::get('ravers/{user:slug}/notifications', [NotificationController::class, 'index'])->name('notifications.index');

});

// Ravers
Route::get('/ravers/{user:slug}', [RaverController::class, 'show'])->name('ravers.show');
Route::get('/ravers/{user:slug}/followers', [RaverController::class, 'followers'])->name('ravers.followers');
Route::get('/ravers/{user:slug}/following', [RaverController::class, 'following'])->name('ravers.following');
Route::get('/ravers/{user:slug}/events', [RaverController::class, 'events'])->name('ravers.events');
// Route::get('/ravers/{user:slug}/posts', [RaverController::class, 'posts']->name('ravers.posts'));

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.event.show');

// 404
Route::get('/logout', function () {
    return abort(404);
});