@extends('blog.layout')

@section('title', $post->meta_title ?? $post->title)
@section('description', $post->meta_description ?? $post->excerpt)

@section('content')
<article class="bg-white rounded-lg shadow-md p-8">
    @if($post->getFirstMediaUrl('cover'))
        <img src="{{ $post->getFirstMediaUrl('cover') }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
    @endif

    <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
    
    <div class="flex items-center text-sm text-gray-600 mb-6">
        <span>{{ $post->author->name }}</span>
        <span class="mx-2">•</span>
        <span>{{ $post->published_at->format('d M Y') }}</span>
        @if($post->category)
            <span class="mx-2">•</span>
            <a href="{{ route('blog.category', $post->category->slug) }}" class="text-blue-600 hover:underline">
                {{ $post->category->name }}
            </a>
        @endif
        <span class="mx-2">•</span>
        <span>{{ $post->views }} görüntülenme</span>
    </div>

    @if($post->tags->count() > 0)
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($post->tags as $tag)
                <a href="{{ route('blog.tag', $tag->slug) }}" class="text-sm bg-gray-100 px-3 py-1 rounded text-gray-700 hover:bg-gray-200">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif

    <div class="prose max-w-none mb-8">
        {!! $post->content !!}
    </div>

    <div class="border-t pt-6">
        <h3 class="text-xl font-bold mb-4">Yorumlar ({{ $post->approvedComments->count() }})</h3>
        
        @if($settings->comments_enabled)
            @auth
                <form action="{{ route('blog.comment.store', $post) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <textarea name="content" rows="4" class="w-full border rounded-lg p-3" placeholder="Yorumunuzu yazın..." required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Yorum Gönder
                    </button>
                </form>
            @else
                <p class="text-gray-600 mb-4">Yorum yapmak için <a href="{{ route('login') }}" class="text-blue-600 hover:underline">giriş yapın</a>.</p>
            @endauth

            @forelse($post->approvedComments->whereNull('parent_id') as $comment)
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex items-center mb-2">
                        <strong class="text-gray-900">{{ $comment->user ? $comment->user->name : $comment->name }}</strong>
                        <span class="text-sm text-gray-600 ml-2">{{ $comment->created_at->format('d M Y') }}</span>
                    </div>
                    <p class="text-gray-700">{{ $comment->content }}</p>
                    
                    @if($comment->replies->count() > 0)
                        <div class="mt-4 ml-4 space-y-2">
                            @foreach($comment->replies as $reply)
                                <div class="bg-white rounded p-3">
                                    <div class="flex items-center mb-1">
                                        <strong class="text-sm text-gray-900">{{ $reply->user ? $reply->user->name : $reply->name }}</strong>
                                        <span class="text-xs text-gray-600 ml-2">{{ $reply->created_at->format('d M Y') }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-600">Henüz yorum yapılmamış.</p>
            @endforelse
        @else
            <p class="text-gray-600">Yorumlar şu anda kapalı.</p>
        @endif
    </div>
</article>
@endsection

