@extends('layouts.blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('dashboard') }}" class="text-amber-800 hover:text-amber-900 mb-4 inline-block font-semibold">
        ← Back to Dashboard
    </a>

    <div class="bg-white shadow-lg rounded-2xl p-8 border border-amber-100">
        <h2 class="text-3xl font-bold mb-2 text-gray-800">Edit Cafe Hunt</h2>
        <p class="text-gray-500 mb-8">Update the details for: <span class="font-bold text-amber-800">{{ $post->title }}</span></p>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Cafe Name</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $post->location) }}" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Author Name</label>
                    <input type="text" name="meta_author" value="{{ old('meta_author', $post->meta_author) }}" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Image URL (Optional)</label>
                    <input type="text" name="image_url" value="{{ old('image_url', $post->image_url) }}" 
                        class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Short Summary (Meta)</label>
                <input type="text" name="meta_description" value="{{ old('meta_description', $post->meta_description) }}" 
                    class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Category</label>
                <select name="category_id" class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
                    <option value="" disabled>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Full Review</label>
                <textarea name="body" rows="6" 
                    class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('dashboard') }}" class="text-gray-400 font-semibold hover:text-gray-600 transition">Cancel</a>
                <button type="submit" class="bg-amber-800 text-white px-10 py-3 rounded-xl font-bold hover:bg-amber-900 transform hover:scale-105 transition shadow-lg">
                    Update Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection