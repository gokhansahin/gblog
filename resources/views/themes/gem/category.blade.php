@extends('themes.gem.layout')

@section('title', $category->name . ' - Kategoriler')
@section('description', $category->description ?? '')
@section('marquee')
    {{ $category->name }} /// {{ $posts->total() }} yazı
@endsection

@section('content')
    <div class="post-item">
        <h1 class="post-title">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-muted">{{ $category->description }}</p>
        @endif
    </div>

    @forelse($posts as $post)
        <article class="post-item">
            <span class="post-meta">
                {{ optional($post->published_at)->format('d M Y') }} /
                {{ $post->category?->name ?? 'Kategori' }}
            </span>
            <h2 class="post-title">
                <a href="{{ route('blog.post', $post->slug) }}" class="text-decoration-none text-white">
                    {{ $post->title }}
                </a>
            </h2>
            @if($post->excerpt)
                <p class="lead text-muted">{{ $post->excerpt }}</p>
            @endif
            <a href="{{ route('blog.post', $post->slug) }}" class="read-btn">Oku</a>
        </article>
    @empty
        <div class="p-5 text-center text-muted">Bu kategoride içerik yok.</div>
    @endforelse

    <div class="p-4">
        {{ $posts->links() }}
    </div>
@endsection

