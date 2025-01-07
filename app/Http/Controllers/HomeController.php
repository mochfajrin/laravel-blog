<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $featuredPosts = Post::published()
            ->with("categories")
            ->featured()
            ->latest("published_at")
            ->take(3)->get();
        $latestPosts = Post::published()
            ->with("categories")
            ->latest("published_at")
            ->take(9)->get();
        return view("home", [
            "featuredPost" => $featuredPosts,
            "latestPost" => $latestPosts,
        ]);
    }
}
