<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // Get the latest post for the big "Main" card
        $mainPost = Post::latest()->first();

        // Get the next 3 posts for the "Recent Discoveries" grid
        $recentPosts = Post::latest()->skip(1)->take(3)->get();

        return view('welcome', compact('mainPost', 'recentPosts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}