@extends('blog.layout')

@section('title', $tag->name . ' - Etiketler')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">#{{ $tag->name }}</h1>
</div>

<div class="space-y-6">
    @forelse($posts as $post)
        <article class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-2">
                <a href="{{ route('blog.post', $post->slug) }}" class="text-gray-900 hover:text-blue-600">
                    {{ $post->title }}
                </a>
            </h2>
            
            <div class="flex items-center text-sm text-gray-600 mb-3">
                <span>{{ $post->author->name }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->published_at->format('d M Y') }}</span>
            </div>
            
            @if($post->excerpt)
                <p class="text-gray-700 mb-4">{{ $post->excerpt }}</p>
            @endif
            
            <a href="{{ route('blog.post', $post->slug) }}" class="text-blue-600 hover:underline">
                Devamını Oku →
            </a>
        </article>
    @empty
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600">Bu etikette henüz yazı bulunmamaktadır.</p>
        </div>
    @endforelse

    {{ $posts->links() }}
</div>
@endsection

