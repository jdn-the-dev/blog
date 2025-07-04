<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            background-image: none;
            position: relative;
        }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon:before,
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon:after {
            content: '';
            position: absolute;
            left: 6px;
            right: 6px;
            height: 3px;
            background: #fff;
            border-radius: 2px;
            top: 50%;
            width: 18px;
        }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon:before {
            transform: translateY(-50%) rotate(45deg);
        }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon:after {
            transform: translateY(-50%) rotate(-45deg);
        }
        .navbar-toggler .navbar-toggler-icon {
            background-color: #fff !important;
            background-image: none !important;
            width: 30px;
            position: relative;
            transition: background 0.2s;
        }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            background: none !important;
        }
        @media screen and (max-width: 768px) {
            .navbar-brand {
                font-size: 29px;
                padding-top: 2rem !important;
            }
            .mobile-header {
                margin-top: -12px;
            }
            
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container mobile-header">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 25px; padding-left: 1rem;">
                    J
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog') }}">{{ __('Blog') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('resources') }}">{{ __('Resources') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">{{ __('About') }}</a>
                        </li>
                        <li class="nav-item" style="text-decoration: none;">
                            <a class="nav-link" href="https://github.com/jdn-the-dev"><i class="fa-brands fa-github"></i></a>
                        </li>
                        <li class="nav-item" style="text-decoration: none;">
                            <a class="nav-link" href="https://www.instagram.com/jaydoncodes/"><i class="fa-brands fa-instagram"></i></a>
                        </li>

                        <li class="nav-item" style="text-decoration: none;">
                            <a class="nav-link" href="https://www.x.com/_jdn__" ><i class="fa-brands fa-x-twitter"></i></a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('create-post') }}">{{ __('Create Post') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.posts.index') }}">{{ __('Admin') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
            <hr class="under-line">
        <main class="py-4 main-content">
            @yield('content')
        </main>
    </div>
</body>
<script>
    // Prevent scrolling when navbar is open (expanded)
    document.addEventListener('DOMContentLoaded', function() {
        var navbarCollapse = document.getElementById('navbarSupportedContent');
        var html = document.documentElement;
        var body = document.body;

        if (navbarCollapse) {
            navbarCollapse.addEventListener('show.bs.collapse', function () {
                html.style.overflow = 'hidden';
                body.style.overflow = 'hidden';
            });
            navbarCollapse.addEventListener('hide.bs.collapse', function () {
                html.style.overflow = '';
                body.style.overflow = '';
            });
        }
    });
</script>
</html>
