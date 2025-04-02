<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JL - {{$post->title}}</title>
        <!-- Title and Description -->
        <meta name="description" content="{{Str::limit(strip_tags($post->blogHTML), 160)}}">
        
        <!-- Keywords -->
        <meta name="keywords" content="Jaydon Lynch, web development, Rust, JavaScript, CSS, Python, coding tips, programming, web design">
        <meta name="thumbnail" content="{{ asset('images/' . $post->image)}}" />

        <!-- Author -->
        <meta name="author" content="Jaydon Lynch">
        <meta itemprop="name" content="{{$post->title}}">
        <meta itemprop="description" content="{{Str::limit(strip_tags($post->blogHTML), 160)}}">
        <meta itemprop="image" content="{{ asset('images/' . $post->image)}}" />
        <meta name="thumbnail" content="{{ asset('images/' . $post->image)}}" />

        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="{{$post->title}}">
        <meta property="og:description" content="{{Str::limit(strip_tags($post->blogHTML), 160)}}">
        <meta name ="image" property="og:image" content="{{ asset('images/' . $post->image)}}" />
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{$post->title}}">
        <meta name="twitter:description" content="{{Str::limit(strip_tags($post->blogHTML), 160)}}">
        <meta name="twitter:image" content="{{ asset('images/' . $post->image)}}">
        <meta property="og:image:secure_url"  content="{{ asset('images/' . $post->image)}}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@_jdn__" />
        <meta name="twitter:creator" content="@_jdn__" />
        <!-- Robots -->
        <meta name="robots" content="index, follow">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">
        
        <!-- Favicon -->
        <link rel="icon" href="https://www.jaydonlynch.dev/favicon.ico" type="image/x-icon">
    </head>
<body>
    @extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 class="post-title" style="font-size: 32px; text-align: center; margin: 1rem">{{$post->title}}</h2>
        <h4 class="d-flex flex-row align-items-center justify-content-center" style="font-size: 14px">{{date_format(date_create($post->created_at), "M j, Y")}} <div> &nbsp;&nbsp;<i class="fa fa-eye" style="font-size: 12px"></i> {{$post->view_count}}</div></h4>
    </div>
    
    <section class="blog-content ql-editor">
        <!-- Ensure proper rendering of code blocks -->
        {!! str_replace(
    'class="ql-code-block-container"',
    ' class="ql-code-block-container" style="background-color: #000; color: #fff; padding: 12px; border-radius: 1rem;"',
    html_entity_decode($post->blogHTML)
) !!}
    </section>

@endsection

    <style>
        .blog-content p {
            word-break: unset;
            line-height: 1.4rem;
        }

        .ql-editor pre {
            white-space: pre-wrap; /* Preserve spaces and line breaks */
            font-family: monospace;
            color: #fff;
            padding: 12px;
            border-radius: 5px;
            overflow: auto; /* Enable scrolling for long code blocks */
        }
        .ql-ui {
            display: none !important;
            margin: 1rem;
        }

        .ql-editor code {
            display: block;
            font-family: monospace;
        }

        .nav-item:hover {
            text-decoration-color: #000 !important;
            color: #000 !important;
        }

        @media (max-width: 768px) {
            .blog-content p {
                word-break: unset;
            }
            .post-title {
                margin: 1rem;
                font-size: 1.5rem !important;
            }
            .ql-editor {
                margin: 1rem;
            }
            .ql-editor img {
                width: 90% !important;
            }
        }
    </style>
</body>
</html>
