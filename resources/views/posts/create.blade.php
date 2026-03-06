@extends('layouts.blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('dashboard') }}" class="text-amber-800 hover:text-amber-900 mb-4 inline-block font-semibold">
        ← Back to Dashboard
    </a>

    <div class="bg-white shadow-lg rounded-2xl p-8 border border-amber-100">
        <h2 class="text-3xl font-bold mb-2 text-gray-800">Add New Cafe Hunt</h2>
        <p class="text-gray-500 mb-8">Share your latest discovery with the community.</p>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Title post</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Ri's Cafe" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. One Riverside" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Author Name</label>
                    <input type="text" name="meta_author" value="{{ old('meta_author') }}" placeholder="Add your name.." 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Cafe Photo</label>
                    <input type="file" name="image_file" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-amber-100 file:text-amber-800">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Short Summary</label>
                <input type="text" name="meta_description" value="{{ old('meta_description') }}" placeholder="A brief hook for your review..." 
                    class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Category</label>
                <select name="category_id" class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Full Review</label>
                <textarea name="body" rows="6" placeholder="Add your full review here..." 
                    class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>{{ old('body') }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('dashboard') }}" class="text-gray-400 font-semibold hover:text-gray-600 transition">Cancel</a>
                <button type="submit" class="bg-amber-800 text-white px-10 py-3 rounded-xl font-bold hover:bg-amber-900 transform hover:scale-105 transition shadow-lg">
                    Publish Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection