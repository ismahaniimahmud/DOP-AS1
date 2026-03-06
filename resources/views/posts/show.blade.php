@extends('layouts.blog')

@section('content')
<main class="max-w-5xl mx-auto px-6 py-12">
    
    
    <div class="mb-10">
        <a href="/" class="text-amber-800 font-medium hover:underline flex items-center">
            <span class="mr-2">←</span> Back to Home
        </a>
    </div>

    <article class="bg-white rounded-[2.5rem] shadow-sm border border-stone-100 overflow-hidden">
        
        {{-- 1. THE IMAGE  --}}
        @if($post->image_url)
            <div class="w-full h-[500px]">
                <img src="{{ asset($post->image_url) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-12 md:p-20">
            {{-- Post Meta --}}
            <p class="text-stone-400 text-sm mb-4">
                Published on {{ $post->created_at->format('F d, Y') }} by {{ $post->meta_author }}
            </p>

            @if($post->category)
                <a href="{{ route('categories.posts', $post->category->id) }}" class="inline-block text-xs font-bold uppercase tracking-widest text-amber-700 hover:underline mb-4">
                    {{ $post->category->name }}
                </a>
            @endif

            {{-- Title --}}
            <h1 class="text-5xl font-extrabold text-stone-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            {{-- 2. THE LOCATION --}}
            <p class="text-amber-700 italic font-bold text-lg mb-10">
                Location: {{ $post->location }}
            </p>

            {{-- Main Body Content --}}
            <div class="prose prose-lg text-stone-700 leading-relaxed space-y-6">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>
    </article>

</main>
@endsection