<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Homepage: Displays the latest cafe discoveries.
     */
    public function index()
    {
        // Get the latest post for the Featured card
        $mainPost = Post::with('category')->latest()->first();

        // Get the next 3 posts for the "Recent Discoveries" section
        $recentPosts = Post::with('category')->latest()->skip(1)->take(3)->get();

        // Only show categories that actually have posts
        $categories = Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('name')
            ->get();

        return view('welcome', compact('mainPost', 'recentPosts', 'categories'));
    }

    /**
     * Dashboard: Management view for the admin.
     */
    public function dashboard()
    {
        // Fetch all posts and categories with counts for the dashboard stats
        $posts = Post::latest()->get();
        $totalPosts = $posts->count();
        $categories = Category::withCount('posts')->get();

        return view('dashboard', compact('posts', 'totalPosts', 'categories'));
    }

    /**
     * Show single post detail.
     */
    public function show(Post $post)
    {
        $post->load('category');

        return view('posts.show', compact('post'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store new post with image upload logic.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'body'             => 'required',
            'location'         => 'required',
            'meta_description' => 'required',
            'meta_author'      => 'required',
            'category_id'      => 'required|exists:categories,id',
            'image_file'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        if ($request->hasFile('image_file')) {
            // Save file to storage/app/public/posts
            $path = $request->file('image_file')->store('posts', 'public');
            // Store the accessible public URL in the database
            $validated['image_url'] = '/storage/' . $path;
        }

        Post::create($validated);

        return redirect()->route('dashboard')->with('success', 'Cafe hunt published successfully!');
    }

    /**
     * Show edit form.
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update existing post and handle image replacement.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'body'             => 'required',
            'location'         => 'required',
            'meta_description' => 'required',
            'meta_author'      => 'required',
            'category_id'      => 'required|exists:categories,id',
            'image_file'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            // Remove old image from storage if a new one is uploaded
            if ($post->image_url) {
                $oldPath = str_replace('/storage/', '', $post->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $path = $request->file('image_file')->store('posts', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Review updated!');
    }

    /**
     * Delete post and associated image.
     */
    public function destroy(Post $post)
    {
        if ($post->image_url) {
            $path = str_replace('/storage/', '', $post->image_url);
            Storage::disk('public')->delete($path);
        }
        
        $post->delete();
        
        return redirect()->route('dashboard')->with('success', 'Post deleted permanently.');
    }

    /**
     * All Discoveries: Paginated view for users.
     */
    public function allPosts()
    {
        $posts = Post::with('category')->latest()->paginate(9); 
        return view('posts.index', compact('posts'));
    }

    /**
     * Filter posts by specific category.
     */
    public function postsByCategory(Category $category)
    {
        $posts = $category->posts()
            ->with('category')
            ->latest()
            ->paginate(9);

        return view('posts.index', [
            'posts' => $posts,
            'selectedCategory' => $category,
        ]);
    }
}