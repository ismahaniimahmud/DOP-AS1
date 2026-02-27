@extends('layouts.blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">All Cafe Discoveries</h1>
        <p class="text-gray-600">Explore every hidden gem we've found so far.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
            <div class="h-48 overflow-hidden">
                <img src="{{ $post->image_url ?? asset('images/default-cafe.jpg') }}" 
                     class="w-full h-full object-cover" alt="{{ $post->title }}">
            </div>
            
            <div class="p-6">
                <p class="text-amber-800 text-xs font-bold uppercase mb-2">{{ $post->location }}</p>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</h3>
                <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ $post->meta_description }}</p>
                
                <a href="{{ route('posts.show', $post->id) }}" class="text-amber-900 font-bold text-sm hover:underline">
                    Read Full Review →
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>
@endsection