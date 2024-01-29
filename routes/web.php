<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\MemeController;
use App\Http\Controllers\MemeTemplateController;
use App\Http\Controllers\AskController;

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

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/trending', [PostController::class, 'trending'])->name('trending');
Route::get('@{user:username}', [UserController::class, 'show'])->name('user-profile');
Route::get('@{user:username}/follows', [UserController::class, 'follows'])->name('user-profile-follows');
Route::get('@{user:username}/followers', [UserController::class, 'followers'])->name('user-profile-followers');
Route::get('/community', [UserController::class, 'index'])->name('community');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('/tag/{slug}', [PostController::class, 'byTag'])->name('tag');

Route::get('/ask', [AskController::class, 'index'])->name('ask.index');
Route::get('/meme', [MemeTemplateController::class, 'index'])->name('meme.index');

Route::get('/shuffle', [PostController::class, 'shuffle'])->name('post.shuffle');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/post/{post}/upvote', [PostController::class, 'upvote'])->name('upvote');
    Route::post('/post/{post}/downvote', [PostController::class, 'downvote'])->name('downvote');
    Route::post('/reply/{reply}/upvote', [ReplyController::class, 'upvote'])->name('reply-upvote');
    Route::post('/reply/{reply}/downvote', [ReplyController::class, 'downvote'])->name('reply-downvote');
    Route::post('/post/{post}/reply', [ReplyController::class, 'store'])->name('reply');
    Route::delete('/reply/{reply}/delete', [ReplyController::class, 'destroy'])->name('reply.destroy');
    Route::post('/{user:username}/follow', [UserController::class, 'follow'])->name('follow');
    Route::post('upload', [PostController::class, 'store'])->name('post.store');
    Route::delete('/{post}/delete', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/meme/create', [MemeController::class, 'create'])->name('meme.create');
    Route::post('/meme/store', [MemeController::class, 'store'])->name('meme.store');

    Route::group(['middleware' => 'admin'], function () {
    });
});
