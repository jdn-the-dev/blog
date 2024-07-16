<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - JL</title>
        <!-- Essential Meta Tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!-- Title and Description -->
        <meta name="description" content="Explore articles, tips, and resources on programming. ">
        
        <!-- Keywords -->
        <meta name="keywords" content="Jaydon Lynch, web development, Rust, JavaScript, CSS, Python, coding tips, programming, web design">
        
        <!-- Author -->
        <meta name="author" content="Jaydon Lynch">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="Jaydon Lynch - Programming Insights and Resources">
        <meta property="og:description" content="Explore expert articles, tips, and resources on web development. Join Jaydon Lynch's community for the latest updates and insights on Laravel, JavaScript, CSS, and more.">
        <meta property="og:image" content="https://jaydonlynch.dev/path/to/your/image.jpg">
        <meta property="og:url" content="https://jaydonlynch.dev">
        <meta property="og:type" content="website">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Jaydon Lynch - Programming Insights and Resources">
        <meta name="twitter:description" content="Explore expert articles, tips, and resources on web development. Join Jaydon Lynch's community for the latest updates and insights on Laravel, JavaScript, CSS, and more.">
        <meta name="twitter:image" content="https://jaydonlynch.dev/path/to/your/image.jpg">
        
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
    </style>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>
    </div>
    @endsection


</body>
</html>