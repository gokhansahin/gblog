@extends('themes.gem.layout')

@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? '')
@section('marquee')
    {{ $page->title }} /// Sayfa
@endsection

@section('content')
<article class="post-item">
    <h1 class="post-title">{{ $page->title }}</h1>
    <div class="lead" style="color: #ccc;">
        {!! $page->content !!}
    </div>
</article>
@endsection

