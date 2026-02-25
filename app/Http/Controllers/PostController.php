<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Homepage: Displays the cafe reviews.
     */
    public function index()
    {
        // Get the latest post for the big "Main" card
        $mainPost = Post::latest()->first();

        // Get the next 3 posts for the "Recent Discoveries" grid
        $recentPosts = Post::latest()->skip(1)->take(3)->get();

        return view('welcome', compact('mainPost', 'recentPosts'));
    }

    /**
     * Dashboard: Management view for admin.
     */
    public function dashboard()
    {
        $posts = Post::latest()->get();
        $totalPosts = $posts->count();
        return view('dashboard', compact('posts', 'totalPosts'));
    }

    /**
     * Show single post detail.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store new post with image upload.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'location' => 'required',
            'meta_description' => 'required',
            'meta_author' => 'required',
            'image_file' => 'nullable|image|max:2048', 
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('posts', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        Post::create($validated);

        return redirect()->route('dashboard')->with('success', 'Cafe hunt published!');
    }

    /**
     * Show edit form.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update existing post.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'location' => 'required',
            'meta_description' => 'required',
            'meta_author' => 'required',
            'image_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            // Delete old image if it exists to save space
            if ($post->image_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $post->image_url));
            }
            $path = $request->file('image_file')->store('posts', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Review updated!');
    }

    /**
     * Delete post.
     */
    public function destroy(Post $post)
    {
        if ($post->image_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $post->image_url));
        }
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted.');
    }

    public function allPosts()
    {
    // Fetch all posts, paginated so the page isn't too long
    $posts = Post::latest()->paginate(9); 
    return view('posts.index', compact('posts'));
    }
}