<?php

namespace App\Http\Middleware;

use App\Http\Resources\CategoryResource;
use Inertia\Middleware;
use App\Models\Category;
use App\Models\Post;
use App\Models\Quote;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },

            'appName' => config('app.name'),

            'auth.user' => fn () => $request->user()
                ? $request->user()
                : null,

            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],

            'categories' => fn () => Category::latest()->get(),

            'tags' => fn () => Post::popularTags(),

            'quote' => fn () => Quote::inRandomOrder()->first(),

            'filters' => $request->only(['search']),

            'unreadNotificationsCount' => $request->user() ? $request->user()->unreadNotifications()->count() : null,

            'can'   =>  [
                'admin' => $request->user() ? $request->user()->id === 1 : null
            ],

            'canRegister' => Route::has('register'),

        ]);
    }
}
