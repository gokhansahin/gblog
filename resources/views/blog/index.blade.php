@extends('blog.layout')

@section('title', 'Ana Sayfa')
@section('description', $settings->site_description ?? '')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <div class="lg:col-span-3">
        <h1 class="text-3xl font-bold mb-6">Son Yazılar</h1>
        
        @forelse($posts as $post)
            <article class="bg-white rounded-lg shadow-md p-6 mb-6">
                @if($post->getFirstMediaUrl('cover'))
                    <img src="{{ $post->getFirstMediaUrl('cover') }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg mb-4">
                @endif
                
                <h2 class="text-2xl font-bold mb-2">
                    <a href="{{ route('blog.post', $post->slug) }}" class="text-gray-900 hover:text-blue-600">
                        {{ $post->title }}
                    </a>
                </h2>
                
                <div class="flex items-center text-sm text-gray-600 mb-3">
                    <span>{{ $post->author->name }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->published_at->format('d M Y') }}</span>
                    @if($post->category)
                        <span class="mx-2">•</span>
                        <a href="{{ route('blog.category', $post->category->slug) }}" class="text-blue-600 hover:underline">
                            {{ $post->category->name }}
                        </a>
                    @endif
                </div>
                
                @if($post->excerpt)
                    <p class="text-gray-700 mb-4">{{ $post->excerpt }}</p>
                @endif
                
                <div class="flex items-center justify-between">
                    <a href="{{ route('blog.post', $post->slug) }}" class="text-blue-600 hover:underline">
                        Devamını Oku →
                    </a>
                    @if($post->tags->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-700 hover:bg-gray-200">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>
        @empty
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <p class="text-gray-600">Henüz yazı bulunmamaktadır.</p>
            </div>
        @endforelse

        {{ $posts->links() }}
    </div>

    <aside class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold mb-4">Kategoriler</h3>
            <ul class="space-y-2">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('blog.category', $category->slug) }}" class="text-gray-700 hover:text-blue-600">
                            {{ $category->name }} ({{ $category->posts_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
@endsection

