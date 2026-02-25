@extends('layouts.blog')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-amber-50 border border-amber-200 p-6 rounded-xl">
                <p class="text-amber-800 font-bold text-sm uppercase">Total Post Cafe Reviews</p>
                <p class="text-4xl font-black text-amber-900 mt-2">{{ $totalPosts }}</p>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('posts.create') }}" class="bg-amber-800 text-white px-4 py-2 rounded">Add New Post</a>
        </div>
    </div>
</div>
@endsection