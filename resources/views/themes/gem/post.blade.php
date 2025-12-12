@extends('themes.gem.layout')

@section('title', $post->meta_title ?? $post->title)
@section('description', $post->meta_description ?? $post->excerpt)
@section('marquee')
    {{ $post->title }} /// {{ $post->category?->name ?? 'Yazı' }} /// {{ optional($post->published_at)->format('d M Y') }}
@endsection

@section('content')
<article class="post-item">
    <span class="post-meta">
        {{ optional($post->published_at)->format('d M Y') }}
        @if($post->category) / {{ $post->category->name }} @endif
        / {{ $post->views }} görüntülenme
    </span>
    <h1 class="post-title">{{ $post->title }}</h1>

    @if($post->getFirstMediaUrl('cover'))
        <div class="post-image-wrapper mb-4">
            <img src="{{ $post->getFirstMediaUrl('cover') }}" class="post-image" style="height: 420px;" alt="{{ $post->title }}">
        </div>
    @endif

    <div class="text-muted mb-4">
        @if($post->tags->count())
            @foreach($post->tags as $tag)
                <a href="{{ route('blog.tag', $tag->slug) }}" class="text-decoration-none text-light me-2">
                    #{{ $tag->name }}
                </a>
            @endforeach
        @endif
    </div>

    <div class="lead" style="color: #ccc;">
        {!! $post->content !!}
    </div>

    <div class="mt-5">
        <h4 class="display-font text-uppercase mb-3">Yorumlar ({{ $post->approvedComments->count() }})</h4>

        @if($settings->comments_enabled)
            @auth
                <form action="{{ route('blog.comment.store', $post) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <textarea name="content" class="form-control bg-dark text-white border-secondary" rows="4" placeholder="Yorumunuzu yazın..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-light">Gönder</button>
                </form>
            @else
                <p class="text-muted">Yorum yapmak için <a href="{{ route('login') }}" class="text-decoration-none text-light">giriş yapın</a>.</p>
            @endauth

            @forelse($post->approvedComments->whereNull('parent_id') as $comment)
                <div class="border border-secondary p-3 mb-3 rounded">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $comment->user?->name ?? $comment->name }}</strong>
                        <span class="text-muted" style="font-size: 0.85rem;">
                            {{ $comment->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <p class="mb-2 text-light">{{ $comment->content }}</p>

                    @if($comment->replies->count())
                        <div class="ms-3 border-start border-secondary ps-3">
                            @foreach($comment->replies as $reply)
                                <div class="mb-2">
                                    <strong>{{ $reply->user?->name ?? $reply->name }}</strong>
                                    <span class="text-muted" style="font-size: 0.8rem;">
                                        {{ $reply->created_at->format('d M Y') }}
                                    </span>
                                    <div class="text-light">{{ $reply->content }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted">Henüz yorum yok.</p>
            @endforelse
        @else
            <p class="text-muted">Yorumlar kapalı.</p>
        @endif
    </div>
</article>
@endsection

