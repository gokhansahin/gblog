@extends('themes.labirent.layout')

@section('title', 'Ana Sayfa')
@section('description', $settings->site_description ?? '')

@section('hero')
<section class="hero">
    <div class="container">
        <h1 class="hero-title">Düşünceler,<br>Hikayeler,<br>Keşifler</h1>
        <p class="hero-subtitle">Her yazı bir yolculuk, her kelime bir adım. Fikir labirentinde kaybolmaya hazır mısınız?</p>
    </div>
</section>
@endsection

@section('content')
    <!-- Blog Grid -->
    <section class="blog-section">
        <div class="container">
            <div class="bento-grid">
                @php
                    $postsArray = $posts->toArray();
                    $cardPattern = [
                        ['type' => 'featured', 'textOnly' => false, 'accent' => false, 'tag' => 'h2'],
                        ['type' => 'medium', 'textOnly' => false, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'small', 'textOnly' => true, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'wide', 'textOnly' => false, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'small', 'textOnly' => false, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'medium', 'textOnly' => false, 'accent' => true, 'tag' => 'h3'],
                        ['type' => 'small', 'textOnly' => false, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'medium', 'textOnly' => false, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'wide', 'textOnly' => true, 'accent' => false, 'tag' => 'h3'],
                        ['type' => 'small', 'textOnly' => false, 'accent' => false, 'tag' => 'h3'],
                    ];
                @endphp
                @foreach($posts as $index => $post)
                    @php
                        $patternIndex = $index % count($cardPattern);
                        $pattern = $cardPattern[$patternIndex];
                        $cardClasses = 'blog-card ' . $pattern['type'];
                        if ($pattern['textOnly']) $cardClasses .= ' text-only';
                        if ($pattern['accent']) $cardClasses .= ' accent-bg';
                        $tag = $pattern['tag'];
                    @endphp
                    <article class="{{ $cardClasses }}">
                        @if(!$pattern['textOnly'] && !$pattern['accent'] && $post->getFirstMediaUrl('cover'))
                            <img src="{{ $post->getFirstMediaUrl('cover') }}" alt="{{ $post->title }}" class="card-image">
                        @endif
                        @if(!$pattern['textOnly'] && !$pattern['accent'])
                            <div class="card-overlay">
                                <span class="card-category">{{ $post->category?->name ?? 'Genel' }}</span>
                                <{{ $tag }} class="card-title">{{ $post->title }}</{{ $tag }}>
                                @if($post->excerpt)
                                    <p class="card-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 150) }}</p>
                                @endif
                                <div class="card-meta">
                                    <span>📅 {{ optional($post->published_at)->format('d M Y') }}</span>
                                    <span>⏱️ {{ ceil(str_word_count(strip_tags($post->content ?? '')) / 200) }} dk{{ $pattern['type'] === 'featured' ? ' okuma' : '' }}</span>
                                </div>
                            </div>
                        @else
                            <div>
                                <span class="card-category">{{ $post->category?->name ?? 'Genel' }}</span>
                                <h3 class="card-title">{{ $post->title }}</h3>
                                @if($post->excerpt)
                                    <p class="card-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 150) }}</p>
                                @endif
                            </div>
                            <div class="card-meta">
                                <span>📅 {{ optional($post->published_at)->format('d M Y') }}</span>
                                <span>⏱️ {{ ceil(str_word_count(strip_tags($post->content ?? '')) / 200) }} dk</span>
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>

            <!-- Load More -->
            <div class="load-more">
                <button class="btn-load">Daha Fazla Yükle</button>
            </div>
        </div>
    </section>
@endsection
