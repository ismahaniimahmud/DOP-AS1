@extends('layouts.blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('dashboard') }}" class="text-amber-800 hover:text-amber-900 mb-4 inline-block font-semibold">
        ← Back to Dashboard
    </a>

    <div class="bg-white shadow-lg rounded-2xl p-8 border border-amber-100">
        <h2 class="text-3xl font-bold mb-2 text-gray-800">Add New Cafe Hunt</h2>
        <p class="text-gray-500 mb-8">Share your latest discovery with the community.</p>

        {{-- enctype is critical for image uploads --}}
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Large Upload Zone --}}
            <div class="col-span-full">
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-3">Cafe Photo</label>
                
                <div class="relative group">
                    <div id="dropzone" 
                        class="flex flex-col items-center justify-center w-full h-80 border-2 border-dashed border-amber-200 rounded-2xl bg-amber-50/30 hover:bg-amber-50 hover:border-amber-400 transition-all cursor-pointer overflow-hidden">
                        
                        {{-- Preview Image (Fills the box once selected) --}}
                        <img id="image-preview" src="#" class="hidden absolute inset-0 w-full h-full object-cover z-0">

                        {{-- Placeholder UI --}}
                        <div id="placeholder-ui" class="flex flex-col items-center justify-center pt-5 pb-6 z-10 text-center px-4">
                            <div class="w-16 h-16 mb-4 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="mb-2 text-base text-amber-900 font-semibold">Click to upload or drag and drop</p>
                            <p class="text-xs text-amber-700/60 font-medium">PNG, JPG or WEBP (Recommended 4:3 ratio, Max: 2MB)</p>
                        </div>

                        {{-- Hidden File Input covering the whole area --}}
                        <input type="file" name="image_file" id="image_file" 
                            class="absolute inset-0 opacity-0 cursor-pointer z-20" 
                            onchange="previewImage(this)" accept="image/*" required>
                    </div>

                    {{-- Change Image Label (Visible after selection) --}}
                    <div id="change-btn" class="hidden absolute top-4 right-4 z-30">
                        <span class="bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-amber-800 shadow-sm border border-amber-100">
                            Change Photo
                        </span>
                    </div>
                </div>
                @error('image_file')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

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
                    <input type="text" name="meta_author" value="{{ old('meta_author') }}" placeholder="Your name.." 
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
            </div>

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2">Short Summary</label>
                <input type="text" name="meta_description" value="{{ old('meta_description') }}" placeholder="A brief hook for your review..." 
                    class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>
            

            <div>
                <label class="block text-xs font-bold text-amber-800 uppercase tracking-widest mb-2"></label>Full Review</label>
                <textarea name="body" rows="6" placeholder="Add your full review here..." 
                    class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 transition" required>{{ old('body') }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('dashboard') }}" class="text-gray-400 font-semibold hover:text-gray-600 transition">Cancel</a>
                <button type="submit" class="bg-amber-800 text-white px-10 py-3 rounded-xl font-bold hover:bg-amber-900 transform hover:scale-105 transition shadow-lg">
                    Publish Review
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('placeholder-ui');
        const changeBtn = document.getElementById('change-btn');
        const dropzone = document.getElementById('dropzone');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                changeBtn.classList.remove('hidden');
                dropzone.classList.remove('border-dashed', 'bg-amber-50/30');
                dropzone.classList.add('border-solid', 'border-amber-400');
            }

            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            changeBtn.classList.add('hidden');
            dropzone.classList.add('border-dashed', 'bg-amber-50/30');
            dropzone.classList.remove('border-solid', 'border-amber-400');
        }
    }
</script>
@endsection