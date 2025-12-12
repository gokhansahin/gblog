@extends('themes.labirent.layout')

@section('title', $post->meta_title ?? $post->title)
@section('description', $post->meta_description ?? $post->excerpt)

@section('hero')
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3 flex-wrap mb-2">
            <span class="badge-soft">{{ $post->category?->name ?? 'Genel' }}</span>
            <span class="text-muted">{{ optional($post->published_at)->format('d M Y') }}</span>
            <span class="text-muted">{{ $post->views }} görüntülenme</span>
        </div>
        <h1 class="hero-title">{{ $post->title }}</h1>
        @if($post->excerpt)
            <p class="hero-subtitle">{{ $post->excerpt }}</p>
        @endif
    </div>
@endsection

@section('content')
    @if($post->getFirstMediaUrl('cover'))
        <div class="mb-4">
            <img src="{{ $post->getFirstMediaUrl('cover') }}" class="w-100 rounded-4" style="max-height:420px; object-fit:cover;" alt="{{ $post->title }}">
        </div>
    @endif

    <div class="mb-5" style="color: #333; line-height: 1.8;">
        {!! $post->content !!}
    </div>

    @if($post->tags->count())
        <div class="mb-4 d-flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
                <a href="{{ route('blog.tag', $tag->slug) }}" class="badge-soft text-decoration-none">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif

    <div class="mt-5">
        <h4 class="fw-bold mb-3">Yorumlar ({{ $post->approvedComments->count() }})</h4>
        @if($settings->comments_enabled)
            @auth
                <form action="{{ route('blog.comment.store', $post) }}" method="POST" class="border rounded-4 p-4 mb-4 bg-white shadow-sm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Yorumunuz</label>
                        <textarea name="content" class="form-control" rows="4" placeholder="Yorumunuzu yazın..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Gönder</button>
                </form>
            @else
                <p class="text-muted">Yorum yapmak için <a href="{{ route('login') }}" class="text-decoration-none">giriş yapın</a>.</p>
            @endauth

            @forelse($post->approvedComments->whereNull('parent_id') as $comment)
                <div class="border rounded-4 p-3 mb-3 bg-white shadow-sm">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $comment->user?->name ?? $comment->name }}</strong>
                        <small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>
                    </div>
                    <p class="mb-2">{{ $comment->content }}</p>

                    @if($comment->replies->count())
                        <div class="ms-3 border-start ps-3">
                            @foreach($comment->replies as $reply)
                                <div class="mb-2">
                                    <strong>{{ $reply->user?->name ?? $reply->name }}</strong>
                                    <small class="text-muted">{{ $reply->created_at->format('d M Y') }}</small>
                                    <div>{{ $reply->content }}</div>
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
@endsection

