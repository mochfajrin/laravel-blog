<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $featuredPosts =
            Cache::remember("featuredPosts", Carbon::now()->addDay(), function () {
                return Post::published()
                    ->with("categories")
                    ->featured()
                    ->latest("published_at")
                    ->take(3)->get();
            });
        $latestPosts = Cache::remember("latestPost", Carbon::now()->addDay(), function () {
            return Post::published()
                ->with("categories")
                ->latest("published_at")
                ->take(9)->get();
        });
        return view("home", [
            "featuredPost" => $featuredPosts,
            "latestPost" => $latestPosts,
        ]);
    }
}
