<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\FollowResource;
use App\Http\Resources\FollowerResource;
use App\Http\Resources\ReplyResource;
use App\Notifications\FollowNotifications;

class UserController extends Controller
{
  public function index(Request $request)
  {
    return Inertia::render('Users/Community', [
      'users' => UserResource::collection(
        User::query()
          ->select('id', 'name', 'username', 'about', 'created_at', 'profile_photo_path')
          ->when($request->input('search'), function ($query, $search) {
            $query->where('username', 'like', "%{$search}%");
          })
          ->withCount(['followings', 'followables', 'posts'])
          ->with('followings', 'followables', 'posts')
          ->orderBy('created_at', 'DESC')
          ->paginate(config('app.limit'))
          ->withQueryString()
      ),
      'filters' =>  $request->only(['search'])
    ]);
  }

  public function show(User $user, Request $request)
  {
    return Inertia::render('Users/Show', [
      'profile'       =>  UserResource::make($user),
      'posts'         =>  PostResource::collection(
        $user->posts()
          ->withCount('replies')
          ->latest()
          ->paginate(config('app.limit'))
      ),
      'replies'       =>  ReplyResource::collection(
        $user->replies()
          ->latest()
          ->paginate(config('app.limit'))
      ),
      'filters'       =>  $request->only(['search']),
    ]);
  }

  public function followers(User $user)
  {
    return Inertia::render('Users/Followers', [
      'profile'       =>  UserResource::make($user),
      'followers'     =>  FollowerResource::collection(
        $user->followers()
          ->latest()
          ->paginate(config('app.limit'))
      )
    ]);
  }

  public function follows(User $user)
  {
    return Inertia::render('Users/Follows', [
      'profile'       =>  UserResource::make($user),
      'follows'       =>  FollowResource::collection(
        $user->followings()
          ->latest()
          ->paginate(config('app.limit'))
      )
    ]);
  }

  public function follow(User $user)
  {
    if (auth()->user()->isFollowing($user)) {
      auth()->user()->unfollow($user);
    } else {
      auth()->user()->toggleFollow($user);
      $user->notify(new FollowNotifications($user, auth()->user()));
    }

    return back();
  }
}
