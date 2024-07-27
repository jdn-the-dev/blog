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
        
        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="Jaydon Lynch - Programming Insights and Resources">
        <meta property="og:description" content="Explore expert articles, tips, and resources on web development. Join Jaydon Lynch's community for the latest updates and insights on Laravel, JavaScript, CSS, and more.">
        <meta property="og:image" content="https://www.jaydonlynch.dev/favicon.ico">
        <meta property="og:url" content="https://jaydonlynch.dev">
        <meta property="og:type" content="website">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Jaydon Lynch - Programming Insights and Resources">
        <meta name="twitter:description" content="Explore expert articles, tips, and resources on web development. Join Jaydon Lynch's community for the latest updates and insights on Laravel, JavaScript, CSS, and more.">
        <meta name="twitter:image" content="https://www.jaydonlynch.dev/favicon.ico">
        
        <!-- Robots -->
        <meta name="robots" content="index, follow">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="https://jaydonlynch.dev">
        
        <!-- Favicon -->
        <link rel="icon" href="https://www.jaydonlynch.dev/favicon.ico" type="image/x-icon">
    <style>
        body {
            background: url("{{ asset('images/white-trees.jpg') }}") no-repeat 50% fixed;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>
    </div>
    @endsection

    <script>
        // JavaScript to handle the loading indicator
        window.addEventListener('load', function() {
          document.getElementById('loading-indicator').style.display = 'none';
        });
      </script>
</body>
</html>