@extends('layouts.blog')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="bg-white shadow-sm sm:rounded-lg p-8">
        
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Admin Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-amber-50 border border-amber-200 p-6 rounded-xl shadow-sm">
                <p class="text-amber-800 font-bold text-sm uppercase tracking-wider">Total Cafe Reviews</p>
                <p class="text-4xl font-black text-amber-900 mt-2">{{ $totalPosts }}</p>
            </div>
        </div>

        <hr class="mb-10 border-stone-100">

        {{-- Post Management Section --}}
        <div class="mb-16">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-700">Manage Your Hunt</h3>
                <a href="{{ route('posts.create') }}" class="bg-amber-800 hover:bg-amber-900 text-white px-6 py-2 rounded-lg transition shadow-md">
                    + Add New Post
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-4 px-2 text-gray-600 font-bold">Title</th>
                            <th class="py-4 px-2 text-gray-600 font-bold">Location</th>
                            <th class="py-4 px-2 text-gray-600 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 px-2 font-medium text-gray-800">{{ $post->title }}</td>
                            <td class="py-4 px-2 text-gray-500 italic">{{ $post->location }}</td>
                            <td class="py-4 px-2 text-right flex justify-end gap-3">
                                <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Edit</a>
                                
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-10 text-center text-gray-400">No cafe reviews found. Start your hunt!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Unified Category Management Section --}}
        <div>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h3 class="text-xl font-semibold text-gray-700">Manage Categories</h3>
                
                {{-- Quick Add Form --}}
                <form action="{{ route('categories.store') }}" method="POST" class="flex gap-2 w-full md:w-auto">
                    @csrf
                    <input type="text" name="name" placeholder="New category..." 
                           class="flex-1 md:w-64 rounded-lg border-gray-200 focus:ring-amber-800 focus:border-amber-800 text-sm" required>
                    <button type="submit" class="bg-amber-800 hover:bg-amber-900 text-white px-4 py-2 rounded-lg transition shadow-sm text-sm font-bold">
                        Add
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-4 px-2 text-gray-600 font-bold">Name</th>
                            <th class="py-4 px-2 text-gray-600 font-bold text-center">Post Count</th>
                            <th class="py-4 px-2 text-gray-600 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 px-2 font-medium text-gray-800">{{ $cat->name }}</td>
                            <td class="py-4 px-2 text-center">
                                <span class="bg-stone-100 text-stone-600 px-2.5 py-0.5 rounded-full text-xs font-bold">
                                    {{ $cat->posts_count }}
                                </span>
                            </td>
                            <td class="py-4 px-2 text-right flex justify-end gap-3">
                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this category? This will not delete associated posts.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-10 text-center text-gray-400">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection