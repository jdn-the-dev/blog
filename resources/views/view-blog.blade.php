@extends('layouts.app')

<head>
    <title>JL - Blog</title>
            <!-- Title and Description -->
        <meta name="description" content="{{$post->title}}">
        
        <!-- Keywords -->
        <meta name="keywords" content="Jaydon Lynch, web development, Rust, JavaScript, CSS, Python, coding tips, programming, web design">
        <meta name="thumbnail" content="{{ asset('images/' . $post->image)}}" />


        <!-- Author -->
        <meta name="author" content="Jaydon Lynch">
        <meta itemprop="name" content="JL - Blog">
        <meta itemprop="description" content="{{$post->title}}">
        <meta itemprop="image" content="{{$post->title}}">

        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="JL - Blog">
        <meta property="og:description" content="{{$post->title}}">
        <meta property="og:image" content="{{$post->title}}">
        <meta property="og:type" content="website">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="JL - Blog">
        <meta name="twitter:description" content="{{$post->title}}">
        <meta name="twitter:image" content="{{ asset('images/' . $post->image)}}">
        
        <!-- Robots -->
        <meta name="robots" content="index, follow">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="https://jaydonlynch.dev">
        
        <!-- Favicon -->
        <link rel="icon" href="https://www.jaydonlynch.dev/favicon.ico" type="image/x-icon">
</head>
@section('content')

    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 class="post-title" style="font-size: 32px; text-align: center; margin: 1rem">{{$post->title}}</h2>
        <h4 class="d-flex flex-row align-items-center justify-content-center" style="font-size: 14px">{{date_format(date_create($post->created_at), "M j, Y")}} <div> &nbsp;&nbsp;<i class="fa fa-eye" style="font-size: 12px"></i> {{$post->view_count}}</div></h4>
    </div>
    <section class="blog-content ql-editor">
        {!! str_replace('class="ql-code-block-container"', 'style="background-color: #000; color: #fff; padding: 12px; border-radius: 1rem"', $post->blogHTML)  !!}
    </section>
@endsection

    <style>
        .blog-content p {
            word-break:break-all;
            line-height: 1.4rem;
        }
        .nav-item:hover{
            text-decoration-color: #000 !important;
            color: #000 !important;
        }
        @media (max-width: 768px) {
            .blog-content p {
                word-break:unset;
            }
            .post-title {
                margin: 1rem;
                font-size: 1.5rem !important;
            }
            .ql-editor {
                margin: 1rem;
            }
            .ql-editor img {
                width: 100% !important;
            }
        }
    </style>