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
            <time datetime="{{ $post->created_at->toDateString() }}">{{ $post->created_at->format('M j, Y') }}</time>
            <span aria-label="{{ number_format($post->view_count) }} views">· <i class="fa fa-eye" aria-hidden="true"></i> {{ number_format($post->view_count) }}</span>
        </p>
        @if ($post->image)
            <img class="blog-post__hero" src="{{ asset('images/'.$post->image) }}"
                 alt="{{ $post->image_alt ?: $post->title }}" fetchpriority="high">
        @endif
    </header>
    <div class="blog-content ql-editor">{!! $post->blogHTML !!}</div>
</article>

<style>
    .blog-post { max-width: 860px; padding-block: 2rem 4rem; }
    .blog-post__header { text-align: center; margin-bottom: 2rem; }
    .blog-post__header h1 { font-size: clamp(2rem, 6vw, 3.5rem); line-height: 1.1; }
    .blog-post__meta { color: #687078; font-size: .9rem; }
    .blog-post__hero { width: 100%; max-height: 520px; object-fit: cover; border-radius: 1rem; margin-top: 1rem; }
    .blog-content { font-size: 1.05rem; line-height: 1.75; overflow-wrap: break-word; }
    .blog-content img { max-width: 100%; height: auto; }
    .blog-content .ql-video { display: block; width: min(100%, 760px); aspect-ratio: 16 / 9; height: auto; margin: 1.5rem auto; border: 0; }
    .blog-content .ql-indent-1:not(.ql-direction-rtl) { padding-left: 4rem !important; }
    .blog-content .ql-indent-2:not(.ql-direction-rtl) { padding-left: 8rem !important; }
    .blog-content .ql-indent-3:not(.ql-direction-rtl) { padding-left: 12rem !important; }
    .blog-content .ql-indent-4:not(.ql-direction-rtl) { padding-left: 16rem !important; }
    .blog-content .ql-indent-5:not(.ql-direction-rtl) { padding-left: 20rem !important; }
    .blog-content .ql-indent-6:not(.ql-direction-rtl) { padding-left: 24rem !important; }
    .blog-content .ql-indent-7:not(.ql-direction-rtl) { padding-left: 28rem !important; }
    .blog-content .ql-indent-8:not(.ql-direction-rtl) { padding-left: 32rem !important; }
    .blog-content .ql-indent-1.ql-direction-rtl { padding-right: 4rem !important; }
    .blog-content .ql-indent-2.ql-direction-rtl { padding-right: 8rem !important; }
    .blog-content .ql-indent-3.ql-direction-rtl { padding-right: 12rem !important; }
    .blog-content .ql-indent-4.ql-direction-rtl { padding-right: 16rem !important; }
    .blog-content .ql-indent-5.ql-direction-rtl { padding-right: 20rem !important; }
    .blog-content .ql-indent-6.ql-direction-rtl { padding-right: 24rem !important; }
    .blog-content .ql-indent-7.ql-direction-rtl { padding-right: 28rem !important; }
    .blog-content .ql-indent-8.ql-direction-rtl { padding-right: 32rem !important; }
    .blog-content pre { overflow-x: auto; padding: 1rem; border-radius: .75rem; background: #111; color: #f8f8f2; white-space: pre-wrap; }
    .blog-content blockquote { border-left: 4px solid #34e7e4; padding-left: 1rem; color: #495057; }
    @media (max-width: 767px) {
        .blog-content .ql-indent-1:not(.ql-direction-rtl) { padding-left: 2rem !important; }
        .blog-content .ql-indent-2:not(.ql-direction-rtl) { padding-left: 4rem !important; }
        .blog-content .ql-indent-3:not(.ql-direction-rtl),
        .blog-content .ql-indent-4:not(.ql-direction-rtl),
        .blog-content .ql-indent-5:not(.ql-direction-rtl),
        .blog-content .ql-indent-6:not(.ql-direction-rtl),
        .blog-content .ql-indent-7:not(.ql-direction-rtl),
        .blog-content .ql-indent-8:not(.ql-direction-rtl) { padding-left: 6rem !important; }
        .blog-content .ql-indent-1.ql-direction-rtl { padding-right: 2rem !important; }
        .blog-content .ql-indent-2.ql-direction-rtl { padding-right: 4rem !important; }
        .blog-content .ql-indent-3.ql-direction-rtl,
        .blog-content .ql-indent-4.ql-direction-rtl,
        .blog-content .ql-indent-5.ql-direction-rtl,
        .blog-content .ql-indent-6.ql-direction-rtl,
        .blog-content .ql-indent-7.ql-direction-rtl,
        .blog-content .ql-indent-8.ql-direction-rtl { padding-right: 6rem !important; }
    }
</style>
@endsection
