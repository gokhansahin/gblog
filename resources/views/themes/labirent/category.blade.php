@extends('themes.labirent.layout')

@section('title', $category->name . ' - Kategoriler')
@section('description', $category->description ?? '')

@section('hero')
    <div class="mb-4">
        <span class="badge-soft">Kategori</span>
        <h1 class="hero-title mt-2">{{ $category->name }}</h1>
        @if($category->description)
            <p class="hero-subtitle">{{ $category->description }}</p>
        @endif
    </div>
@endsection

@section('content')
    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-md-6 col-xl-4">
                <article class="card-lab h-100">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge-soft">{{ $post->category?->name ?? 'Genel' }}</span>
                            <small class="text-muted">{{ optional($post->published_at)->format('d M Y') }}</small>
                        </div>
                        <h3 class="h5 fw-bold mb-2">
                            <a href="{{ route('blog.post', $post->slug) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h3>
                        @if($post->excerpt)
                            <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}</p>
                        @endif
                        <a href="{{ route('blog.post', $post->slug) }}" class="text-decoration-none fw-semibold" style="color: var(--accent);">
                            Devamını oku →
                        </a>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="p-4 border rounded-4 bg-white">Bu kategoride içerik yok.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection

