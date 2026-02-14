<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/article/{post}', [PostController::class, 'show'])->name('posts.show');


Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    
   
    Route::get('/dashboard', function () {
        $totalPosts = Post::count(); 
        return view('dashboard', compact('totalPosts'));
    })->name('dashboard');

    
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    
    // Profile Routes (Default Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
