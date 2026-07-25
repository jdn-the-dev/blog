@extends('layouts.app')

@section('title', $post->seo_title.' | '.config('app.name'))

@push('head')
    <meta name="description" content="{{ $post->excerpt }}">
    <meta name="author" content="Jaydon Lynch">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ route('posts.show', $post) }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->seo_title }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <meta property="og:url" content="{{ route('posts.show', $post) }}">
    <meta property="og:image" content="{{ asset('images/'.$post->image) }}">
    <meta property="article:published_time" content="{{ $post->created_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->seo_title }}">
    <meta name="twitter:description" content="{{ $post->excerpt }}">
    <meta name="twitter:image" content="{{ asset('images/'.$post->image) }}">
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'image' => [asset('images/'.$post->image)],
            'author' => ['@type' => 'Person', 'name' => 'Jaydon Lynch', 'url' => url('/about')],
            'publisher' => ['@type' => 'Person', 'name' => 'Jaydon Lynch', 'url' => url('/')],
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'mainEntityOfPage' => route('posts.show', $post),
            'keywords' => $post->category ?? [],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}
    </script>
@endpush

@section('content')
<article class="container blog-post">
    <header class="blog-post__header">
        <h1>{{ $post->title }}</h1>
        <p class="blog-post__meta">
            <time datetime="{{ $post->created_at->toDateString() }}">
                <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                <span>{{ $post->created_at->format('F j, Y') }}</span>
            </time>
            <span aria-label="{{ number_format($post->view_count) }} views">
                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                <span>{{ number_format($post->view_count) }} {{ Str::plural('view', $post->view_count) }}</span>
            </span>
        </p>
        @if ($post->image)
            <div class="blog-post__hero-frame">
                <img class="blog-post__hero" src="{{ asset('images/'.$post->image) }}"
                     alt="{{ $post->image_alt ?: $post->title }}" fetchpriority="high">
            </div>
        @endif
    </header>
    <div class="blog-content ql-editor">{!! $post->blogHTML !!}</div>
</article>
@endsection
