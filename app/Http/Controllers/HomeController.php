<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return view("home", [
            "featuredPost" => Post::published()->featured()->latest("published_at")->take(3)->get(),
            "latestPost" => Post::published()->latest("published_at")->take(9)->get(),
        ]);
    }
}
