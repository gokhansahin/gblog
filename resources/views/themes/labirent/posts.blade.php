@extends('themes.labirent.layout')

@section('title', $settings->default_meta_title )
@section('description', $settings->default_meta_description )


    @section('hero')
        <section class="hero">
            <div class="container">
                <h1 class="hero-title">Yazılarım</h1>
                <p class="hero-subtitle">Her yazı bir yolculuk, her kelime bir adım. Fikir labirentinde kaybolmaya hazır mısınız?</p>
            </div>
        </section>
    @endsection


    @section('content')
        <section class="blog-section">
            <div class="container">
                <div class="bento-grid">

                    @foreach($posts as $index => $post)
                        <article class="blog-card small" style="opacity: 1; transform: translateY(0px); transition: 0.6s ease-out;">
                            <img src="{{$post->getFirstMediaUrl('cover')}}" alt="Blog" class="card-image">
                            <div class="card-overlay">
                                <span class="card-category">{{$post->category->name}}</span>
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <p class="card-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 50) }}</p>
                                <div class="card-meta">
                                    <span>📅 {{ optional($post->published_at)->format('d M Y') }}</span>
                                    <span>⏱️ {{ ceil(str_word_count(strip_tags($post->content ?? '')) / 200) }} dk</span>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </section>



    @endsection
