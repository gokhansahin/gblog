@extends('themes.gem.layout')

@section('title', 'Ana Sayfa')
@section('description', $settings->site_description ?? '')
@section('marquee')
    @if($posts->count() > 0)
        {{ $posts->take(3)->map(fn($p) => $p->title)->implode(' /// ') }}
    @else
        {{ $settings->site_name ?? 'GBlog' }} /// Yeni yazılar yakında
    @endif
@endsection

@section('content')
    @foreach($posts as $post)
        <article class="post-item">
            <span class="post-meta">
                {{ optional($post->published_at)->format('d M Y') }} /
                {{ $post->category?->name ?? 'Kategori' }} /
                {{ $post->read_time ?? '' }}
            </span>
            <h2 class="post-title">
                <a href="{{ route('blog.post', $post->slug) }}" class="text-decoration-none text-white">
                    {{ $post->title }}
                </a>
            </h2>
            @if($post->getFirstMediaUrl('cover'))
                <div class="post-image-wrapper">
                    <img src="{{ $post->getFirstMediaUrl('cover') }}" class="post-image" alt="{{ $post->title }}">
                </div>
            @endif
            @if($post->excerpt)
                <p class="lead text-muted mt-2">{{ $post->excerpt }}</p>
            @endif
            <a href="{{ route('blog.post', $post->slug) }}" class="read-btn">Oku</a>
        </article>
    @endforeach

    <div class="p-4">
        {{ $posts->links() }}
    </div>
@endsection

