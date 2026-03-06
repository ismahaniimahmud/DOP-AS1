<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/article/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{category}', [PostController::class, 'postsByCategory'])->name('categories.posts');


Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::get('/discoveries', [PostController::class, 'allPosts'])->name('posts.index');

// Protected Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        $posts = Post::latest()->get(); // Fetch all posts to show in the table
        $totalPosts = $posts->count();   // Count them for the summary widget
        return view('dashboard', compact('posts', 'totalPosts'));
    })->name('dashboard');

    // CRUD Resource (handles Create, Store, Edit, Update, Destroy)
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
