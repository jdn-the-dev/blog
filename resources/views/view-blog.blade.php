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
    <div class="wavy-line-container">
        <svg class="400  mb-6 lg:mb-12 md:block lg:hidden wavy-line" data-name="Wavey Line" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 19" aria-hidden="true">
            <title>Wavy Line</title>
            <defs>
              <clipPath>
                <rect data-name="Rectangle 6601" width="1641" height="19" transform="translate(0 0.216)" fill="#34e7e4" stroke="#34e7e4" stroke-width="1"></rect>
              </clipPath>
            </defs>
            <g data-name="Group 14527" transform="translate(0 -0.216)">
              <path data-name="Path 18152" d="M1620.982,18.971c-5.106,0-7.686-4.658-10.182-9.164-2.537-4.579-4.933-8.9-9.837-8.9s-7.3,4.324-9.835,8.9c-2.5,4.506-5.076,9.164-10.18,9.164s-7.685-4.658-10.181-9.164c-2.536-4.579-4.932-8.9-9.835-8.9s-7.3,4.324-9.835,8.9c-2.495,4.506-5.075,9.164-10.18,9.164s-7.685-4.659-10.181-9.165C1528.2,5.228,1525.805.9,1520.9.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.685-4.658-10.18-9.164c-2.536-4.579-4.932-8.9-9.835-8.9s-7.3,4.324-9.834,8.9c-2.5,4.506-5.076,9.165-10.18,9.165s-7.685-4.658-10.18-9.164c-2.536-4.579-4.932-8.9-9.835-8.9s-7.3,4.324-9.834,8.9c-2.495,4.506-5.075,9.164-10.18,9.164s-7.685-4.658-10.18-9.164c-2.536-4.579-4.932-8.9-9.834-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.165-10.18,9.165s-7.685-4.658-10.18-9.164c-2.536-4.579-4.932-8.9-9.834-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.18,9.164s-7.685-4.658-10.18-9.164c-2.536-4.579-4.932-8.9-9.835-8.9s-7.3,4.324-9.833,8.9c-2.495,4.506-5.075,9.165-10.179,9.165s-7.684-4.659-10.179-9.165c-2.536-4.578-4.931-8.9-9.833-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.075,9.165-10.179,9.165s-7.683-4.658-10.178-9.164c-2.536-4.579-4.931-8.9-9.833-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.075,9.165-10.179,9.165s-7.685-4.658-10.179-9.164c-2.536-4.579-4.932-8.9-9.834-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164S1173,14.312,1170.5,9.806c-2.536-4.578-4.932-8.9-9.833-8.9s-7.3,4.324-9.834,8.9c-2.494,4.506-5.075,9.165-10.179,9.165s-7.684-4.658-10.179-9.164c-2.536-4.579-4.932-8.9-9.833-8.9s-7.3,4.324-9.834,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.684-4.658-10.18-9.164c-2.536-4.579-4.932-8.9-9.834-8.9s-7.3,4.324-9.833,8.9c-2.495,4.506-5.075,9.165-10.18,9.165s-7.685-4.658-10.179-9.164c-2.536-4.579-4.931-8.9-9.834-8.9s-7.3,4.324-9.834,8.9c-2.5,4.506-5.075,9.164-10.18,9.164s-7.684-4.658-10.179-9.164c-2.536-4.579-4.931-8.9-9.834-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.684-4.658-10.178-9.164C967.836,5.228,965.442.9,960.54.9s-7.3,4.324-9.833,8.9c-2.495,4.506-5.075,9.165-10.179,9.165s-7.685-4.658-10.18-9.164c-2.536-4.579-4.931-8.9-9.834-8.9s-7.3,4.324-9.834,8.9c-2.495,4.506-5.075,9.164-10.178,9.164s-7.684-4.659-10.18-9.165C887.787,5.228,885.391.9,880.49.9s-7.3,4.324-9.834,8.9c-2.495,4.506-5.075,9.165-10.179,9.165s-7.684-4.658-10.179-9.164c-2.535-4.579-4.931-8.9-9.832-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.165-10.179,9.165s-7.684-4.658-10.179-9.164c-2.536-4.579-4.931-8.9-9.833-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.074,9.164-10.179,9.164s-7.684-4.658-10.179-9.164c-2.536-4.579-4.931-8.9-9.833-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.684-4.658-10.179-9.164C727.69,5.228,725.3.9,720.393.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.074,9.165-10.179,9.165S692.7,14.313,690.2,9.807C687.667,5.228,685.272.9,680.37.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.685-4.659-10.179-9.165c-2.536-4.578-4.931-8.9-9.834-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.074,9.164-10.178,9.164s-7.684-4.658-10.178-9.164c-2.536-4.579-4.931-8.9-9.834-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.074,9.165-10.179,9.165s-7.684-4.658-10.178-9.164C567.6,5.228,565.2.9,560.3.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.18,9.164s-7.684-4.659-10.178-9.165c-2.536-4.578-4.93-8.9-9.832-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.074,9.164-10.178,9.164s-7.684-4.658-10.178-9.164c-2.536-4.579-4.931-8.9-9.833-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.074,9.165-10.178,9.165s-7.683-4.658-10.178-9.164c-2.536-4.579-4.931-8.9-9.833-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.075,9.165-10.179,9.165s-7.683-4.658-10.178-9.164c-2.535-4.579-4.93-8.9-9.832-8.9s-7.3,4.324-9.832,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.684-4.658-10.179-9.164C367.49,5.228,365.095.9,360.193.9s-7.3,4.324-9.832,8.9c-2.495,4.506-5.074,9.164-10.178,9.164s-7.683-4.658-10.178-9.164C327.47,5.228,325.075.9,320.173.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.165-10.179,9.165s-7.683-4.659-10.178-9.165c-2.535-4.578-4.93-8.9-9.832-8.9s-7.3,4.324-9.831,8.9c-2.495,4.506-5.074,9.164-10.178,9.164s-7.683-4.658-10.178-9.164c-2.535-4.579-4.931-8.9-9.832-8.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.683-4.658-10.178-9.164c-2.535-4.579-4.93-8.9-9.831-8.9s-7.3,4.324-9.831,8.9c-2.495,4.506-5.074,9.165-10.178,9.165s-7.683-4.658-10.178-9.164c-2.535-4.579-4.93-8.9-9.832-8.9s-7.3,4.324-9.833,8.9c-2.495,4.506-5.075,9.164-10.178,9.164S132.4,14.313,129.9,9.807C127.366,5.228,124.971.9,120.07.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.684-4.658-10.179-9.164C87.343,5.228,84.948.9,80.046.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164s-7.683-4.658-10.178-9.164C47.32,5.228,44.925.9,40.023.9s-7.3,4.324-9.833,8.9c-2.5,4.506-5.075,9.164-10.179,9.164S12.328,14.313,9.833,9.807C7.3,5.228,4.9.9,0,.9V0C5.1,0,7.684,4.658,10.179,9.164c2.535,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C32.339,4.658,34.919,0,40.023,0S47.707,4.659,50.2,9.165c2.535,4.578,4.931,8.9,9.832,8.9s7.3-4.324,9.833-8.9C72.362,4.658,74.942,0,80.046,0S87.73,4.659,90.225,9.165c2.536,4.578,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C112.385,4.658,114.965,0,120.07,0s7.684,4.658,10.179,9.164c2.535,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.832-8.9C152.408,4.659,154.989,0,160.093,0s7.683,4.658,10.178,9.164c2.535,4.579,4.93,8.9,9.832,8.9s7.3-4.324,9.832-8.9C192.429,4.658,195.008,0,200.112,0s7.683,4.658,10.177,9.164c2.535,4.579,4.93,8.9,9.832,8.9s7.3-4.324,9.833-8.9C232.449,4.658,235.028,0,240.132,0s7.683,4.659,10.178,9.165c2.535,4.578,4.93,8.9,9.832,8.9s7.3-4.324,9.832-8.9C272.469,4.658,275.048,0,280.151,0s7.683,4.658,10.178,9.164c2.535,4.579,4.93,8.9,9.832,8.9s7.3-4.324,9.833-8.9C312.49,4.658,315.07,0,320.173,0s7.683,4.659,10.178,9.165c2.535,4.578,4.93,8.9,9.832,8.9s7.3-4.324,9.832-8.9C352.51,4.658,355.09,0,360.193,0s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.832-8.9C392.532,4.658,395.111,0,400.215,0s7.683,4.658,10.178,9.164c2.535,4.579,4.931,8.9,9.832,8.9s7.3-4.324,9.833-8.9C432.552,4.658,435.132,0,440.236,0s7.684,4.659,10.179,9.165c2.535,4.578,4.931,8.9,9.832,8.9s7.3-4.324,9.832-8.9C472.573,4.658,475.154,0,480.257,0s7.684,4.658,10.179,9.164c2.535,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.832-8.9C512.6,4.659,515.176,0,520.279,0s7.683,4.658,10.178,9.164c2.535,4.579,4.931,8.9,9.832,8.9s7.3-4.324,9.834-8.9C552.618,4.658,555.2,0,560.3,0s7.683,4.658,10.178,9.164c2.535,4.579,4.931,8.9,9.832,8.9s7.3-4.324,9.833-8.9C592.64,4.658,595.22,0,600.323,0s7.684,4.659,10.179,9.165c2.535,4.578,4.931,8.9,9.833,8.9s7.3-4.324,9.832-8.9C632.662,4.658,635.242,0,640.346,0s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.834,8.9s7.3-4.324,9.833-8.9C672.686,4.658,675.266,0,680.37,0s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C712.71,4.658,715.29,0,720.393,0s7.684,4.658,10.18,9.164c2.535,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C752.733,4.658,755.313,0,760.417,0S768.1,4.658,770.6,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C792.757,4.658,795.337,0,800.441,0s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C832.782,4.658,835.362,0,840.466,0s7.684,4.658,10.178,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.834-8.9C872.806,4.658,875.386,0,880.49,0s7.684,4.658,10.178,9.164c2.536,4.579,4.931,8.9,9.834,8.9s7.3-4.324,9.832-8.9C912.83,4.659,915.41,0,920.514,0s7.685,4.658,10.18,9.164c2.536,4.579,4.931,8.9,9.834,8.9s7.3-4.324,9.833-8.9C952.856,4.658,955.436,0,960.54,0s7.684,4.659,10.179,9.165c2.536,4.578,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C992.879,4.658,995.46,0,1000.564,0s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.834-8.9C1032.9,4.658,1035.485,0,1040.59,0s7.685,4.658,10.18,9.164c2.536,4.579,4.932,8.9,9.834,8.9s7.3-4.324,9.834-8.9C1072.932,4.658,1075.512,0,1080.616,0s7.685,4.658,10.18,9.164c2.536,4.579,4.932,8.9,9.834,8.9s7.3-4.324,9.833-8.9c2.5-4.506,5.075-9.165,10.18-9.165s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.834-8.9c2.5-4.506,5.075-9.164,10.179-9.164s7.685,4.658,10.179,9.164c2.536,4.579,4.932,8.9,9.835,8.9s7.3-4.324,9.833-8.9C1193.01,4.658,1195.59,0,1200.695,0s7.684,4.659,10.18,9.165c2.536,4.578,4.931,8.9,9.833,8.9s7.3-4.324,9.833-8.9C1233.036,4.658,1235.616,0,1240.719,0s7.684,4.659,10.179,9.165c2.536,4.578,4.931,8.9,9.832,8.9s7.3-4.324,9.833-8.9C1273.058,4.658,1275.638,0,1280.741,0s7.684,4.658,10.179,9.164c2.536,4.579,4.931,8.9,9.833,8.9s7.3-4.324,9.834-8.9C1313.082,4.658,1315.662,0,1320.765,0s7.685,4.659,10.181,9.165c2.536,4.578,4.931,8.9,9.834,8.9s7.3-4.324,9.834-8.9C1353.109,4.658,1355.689,0,1360.793,0s7.684,4.658,10.18,9.164c2.536,4.579,4.932,8.9,9.834,8.9s7.3-4.324,9.833-8.9c2.5-4.506,5.075-9.164,10.179-9.164S1408.5,4.658,1411,9.164c2.536,4.579,4.932,8.9,9.834,8.9s7.3-4.324,9.834-8.9c2.495-4.506,5.075-9.164,10.18-9.164s7.685,4.659,10.18,9.165c2.536,4.578,4.932,8.9,9.835,8.9s7.3-4.324,9.835-8.9c2.495-4.506,5.075-9.164,10.18-9.164s7.685,4.659,10.181,9.165c2.536,4.578,4.932,8.9,9.834,8.9s7.3-4.324,9.833-8.9C1513.219,4.659,1515.8,0,1520.9,0s7.685,4.658,10.18,9.164c2.536,4.579,4.932,8.9,9.835,8.9s7.3-4.324,9.834-8.9c2.5-4.506,5.075-9.165,10.181-9.165s7.686,4.659,10.181,9.165c2.536,4.578,4.931,8.9,9.835,8.9s7.3-4.324,9.835-8.9c2.495-4.506,5.076-9.164,10.18-9.164s7.687,4.659,10.182,9.165c2.536,4.578,4.932,8.9,9.836,8.9s7.3-4.324,9.836-8.9C1633.314,4.658,1635.894,0,1641,0V.9c-4.9,0-7.3,4.324-9.837,8.9-2.5,4.506-5.076,9.164-10.182,9.164" transform="translate(0 0.245)" fill="#34e7e4" stroke="#34e7e4" stroke-width="1"></path>
            </g>
          </svg>
    </div>

@endsection

    <style>
        .wavy-line-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .wavy-line {
            width: 15em;
            color: aqua;
        }
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
