@extends('themes.labirent.layout')

@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? '')

@section('hero')
    <div class="mb-4">
        <h1 class="hero-title">{{ $page->title }}</h1>
    </div>
@endsection

@section('content')
<article class="card-lab p-4">
    <div style="color:#333; line-height:1.8;">
        {!! $page->content !!}
    </div>
</article>
@endsection

