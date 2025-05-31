<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - JL</title>
        <!-- Essential Meta Tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">        
        <!-- Title and Description -->
        <meta name="description" content="Explore blog posts, tips, and resources on tech/programming. ">
        
        <!-- Keywords -->
        <meta name="keywords" content="Jaydon Lynch, web development, Rust, JavaScript, CSS, Python, coding tips, programming, web design">
        
        <!-- Author -->
        <meta name="author" content="Jaydon Lynch">
        <meta name="thumbnail" content="{{ asset('images/j-train.jpg')}}" />
        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="Jaydon Lynch: A Developer and Creator">
<meta property="og:description"
  content="Exploring the intersection of life and productivity, I share insights as a developer and creator. From coding and creative projects to practical tips for living a balanced, productive life, my journey is all about growth, innovation, and inspiring others." />
        <meta property="og:image" content="{{ asset('images/j-train.jpg')}}" />
        <meta property="og:url" content="https://jaydonlynch.dev">
        <meta property="og:type" content="website">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:title" content="A Developer and Creator.">
        <meta name="twitter:image" content="{{ asset('images/j-train.jpg')}}" />
        
        <!-- Robots -->
        <meta name="robots" content="index, follow">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">
        
        <!-- Favicon -->
        <link rel="icon" href="https://www.jaydonlynch.dev/favicon.ico" type="image/x-icon">
    <style>
      html {
        background-color: #fff;
        height: 100%;
        overflow-y: hidden;
      }
        body {
          margin:0.5rem !important;
          border-radius: 12px;
          height: 98.5%;
            background: url("{{ asset('images/j-train.jpg') }}") no-repeat 50% fixed;
            background-size: cover;
        }
        .navbar-brand{
            color: #fff !important;
        }
        .nav-link {
            color: #fff !important;
        }
        .nav-link:hover {
          text-decoration-color: #fff !important;
  
        }
        .under-line {
            color: #fff !important;
        }
        .navbar-toggler-icon{
            background-color: #fff !important;
        }
        .navbar-toggler-icon::after{
            background-color: #fff !important;
        }
        .navbar-toggler-icon::before{
            background-color: #fff !important;
        }
        @media (max-width: 768px) {
            .nav-link {
                color: #000 !important;
            }
        }
        /* Loading Indicator Styles */
        #loading-indicator {
          position: fixed;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          background-color: rgba(255, 255, 255, 0.8);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 9999;
        }
    
        .spinner {
          width: 80px;
          height: 80px;
          display: flex;
          align-items: center;
          justify-content: center;
          position: relative;
        }
    
        .spinner div {
          box-sizing: border-box;
          position: absolute;
          width: 64px;
          height: 64px;
          border: 2px solid #000;
          border-radius: 50%;
          animation: spinner 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
          border-color: #000 transparent transparent transparent;
        }
    
        .spinner div:nth-child(1) {
          animation-delay: -0.45s;
        }
    
        .spinner div:nth-child(2) {
          animation-delay: -0.3s;
        }
    
        .spinner div:nth-child(3) {
          animation-delay: -0.15s;
        }
    
        @keyframes spinner {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }
    
        .nav-item:hover {
          color: #000 !important;
        }
      </style>

</head>
<body>
    <div id="loading-indicator">
        <div class="spinner">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>

    @extends('layouts.app')
    @section('content')
    @endsection

    <script>
        // JavaScript to handle the loading indicator
        window.addEventListener('load', function() {
          document.getElementById('loading-indicator').style.display = 'none';
        });
      </script>
    <footer style="text-align:center; color:#fff; margin-top:2rem; text-shadow: 1px 1px 2px #000; position: absolute; bottom: 0; width: -webkit-fill-available; padding: 1rem; ">
        <span style="font-size: 11px">&copy; {{ date('Y') }} Jaydon Lynch. All rights reserved.</span> 
    </footer>
</body>
</html>