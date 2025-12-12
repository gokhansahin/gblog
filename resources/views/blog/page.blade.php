@extends('blog.layout')

@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? '')

@section('content')
<article class="bg-white rounded-lg shadow-md p-8">
    <h1 class="text-4xl font-bold mb-6">{{ $page->title }}</h1>
    
    <div class="prose max-w-none">
        {!! $page->content !!}
    </div>
</article>
@endsection

