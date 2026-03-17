<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\Category; 
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/article/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{category}', [PostController::class, 'postsByCategory'])->name('categories.posts');


Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::get('/discoveries', [PostController::class, 'allPosts'])->name('posts.index');


Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        $posts = Post::latest()->get(); 
        $totalPosts = $posts->count();
        
        // Fetch categories with their post counts
        $categories = Category::withCount('posts')->get();

        
        return view('dashboard', compact('posts', 'totalPosts', 'categories'));
    })->name('dashboard');

    // Category CRUD 
    Route::resource('categories', CategoryController::class)->only(['store', 'update', 'destroy']);
    
    // Post CRUD
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
