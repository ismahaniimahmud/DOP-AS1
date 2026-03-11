@extends('layouts.blog')

@section('content')
<main class="max-w-6xl mx-auto px-4 mt-12">

    {{-- Categories Section --}}
    <section class="mb-16">
        <h2 class="text-sm font-semibold uppercase tracking-widest text-amber-600 mb-4">Category</h2>
        <div class="flex flex-wrap gap-3">
            @forelse($categories as $category)
                <a href="{{ route('categories.posts', $category->id) }}" 
                   class="inline-flex items-center bg-white border border-stone-200 px-4 py-1.5 rounded-full shadow-sm hover:border-amber-800 hover:shadow-md transition group">
                    <span class="text-sm font-bold text-stone-700 group-hover:text-amber-900">
                        #{{ $category->name }}
                    </span>
                    <span class="ml-2 text-[10px] font-medium bg-stone-100 text-stone-500 px-1.5 py-0.5 rounded-full group-hover:bg-amber-50 group-hover:text-amber-700">
                        {{ $category->posts_count }}
                    </span>
                </a>
            @empty
                <p class="text-stone-400 italic text-sm">No categories available yet.</p>
            @endforelse
        </div>
    </section>

    {{-- 1. Main Highlight Post--}}
    @if($mainPost)
    <section class="mb-16 mt-10">
        <h2 class="text-sm font-semibold uppercase tracking-widest text-amber-600 mb-4">Featured</h2>
        <div class="grid md:grid-cols-2 gap-8 items-center bg-white rounded-2xl overflow-hidden shadow-md border border-stone-100">
            
            
            <div class="h-96 bg-stone-100 flex items-center justify-center">
                @if($mainPost->image_url)
                    <img src="{{ asset($mainPost->image_url) }}" 
                         alt="{{ $mainPost->title }}" 
                         class="w-full h-full object-cover">
                @else
                    <span class="italic text-stone-400 font-bold">CAFE IMAGE</span>
                @endif
            </div>

            <div class="p-8">
                <p class="text-xs text-stone-500 mb-2">
                    Published: {{ $mainPost->created_at->format('M d, Y') }} | Author: {{ $mainPost->meta_author }}
                </p>
                @if($mainPost->category)
                    <a href="{{ route('categories.posts', $mainPost->category->id) }}" class="inline-block text-xs font-bold uppercase tracking-widest text-amber-700 hover:underline mb-3">
                        {{ $mainPost->category->name }}
                    </a>
                @endif
                <h3 class="text-4xl font-bold mb-4 text-stone-900">{{ $mainPost->title }}</h3>
                
                
                
                <p class="text-stone-600 mb-6 leading-relaxed">
                    {{ Str::limit($mainPost->body, 200) }}
                </p>
                
                <p class="text-sm italic text-amber-700 mb-6 font-bold">Location: {{ $mainPost->location }}</p>
                
                <a href="{{ route('posts.show', $mainPost->id) }}" class="inline-block border-2 border-amber-800 text-amber-800 px-6 py-2 font-bold hover:bg-amber-800 hover:text-white transition rounded-lg">
                    Read Full Review
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- 2. Recent Discoveries --}}
    <section class="mb-20">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-stone-800">Recent Discoveries</h2>
            <a href="{{ route('posts.index') }}" class="text-amber-700 font-bold hover:underline flex items-center">
                View More <span class="ml-1">&rarr;</span>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($recentPosts as $post)
                <article class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition border border-stone-50 flex flex-col">
                    
                    {{-- Image retrieval --}}
                    @if($post->image_url)
                        <img src="{{ asset($post->image_url) }}" 
                             class="w-full h-40 object-cover rounded-xl mb-4 shadow-sm"
                             alt="{{ $post->title }}">
                    @endif

                    <p class="text-xs text-stone-400 mb-2">{{ $post->created_at->format('M d, Y') }}</p>
                    @if($post->category)
                        <a href="{{ route('categories.posts', $post->category->id) }}" class="inline-block text-xs font-bold uppercase tracking-widest text-amber-700 hover:underline mb-2">
                            {{ $post->category->name }}
                        </a>
                    @endif
                    <h4 class="text-xl font-bold mb-3 text-amber-900">{{ $post->title }}</h4>
                    <p class="text-stone-600 text-sm mb-6 flex-grow">
                        {{ Str::limit($post->body, 100) }}
                    </p>
                    <a href="{{ route('posts.show', $post->id) }}" class="text-amber-700 font-bold text-sm hover:underline flex items-center">
                        Read More <span class="ml-1">&rarr;</span>
                    </a>
                </article>
            @empty
                <p class="text-stone-400 italic">No discoveries yet.</p>
            @endforelse
        </div>
    </section>

</main>
@endsection