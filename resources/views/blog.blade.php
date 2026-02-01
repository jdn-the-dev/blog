<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - JL | Web Development Insights</title>

  <!-- SEO Meta Tags -->
  <meta name="description" content="Insights, tips, and resources on tech, programming, and productivity by Jaydon Lynch - a developer and quantitative thinker. Explore development tutorials, coding practices, and real-world problem solving.">
  <meta name="keywords" content="Jaydon Lynch, web development, Rust, JavaScript, CSS, Python, productivity, coding tips, programming, web design, tech insights, developer blog, quantitative thinking">
  <meta name="author" content="Jaydon Lynch">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="Blog - JL | Developer Insights & Programming Tips">
  <meta property="og:description" content="Insights on tech, programming, and productivity from a developer and quantitative thinker. Real-world problem solving and technical growth.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="Jaydon Lynch">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Blog - JL | Developer Insights & Programming Tips">
  <meta name="twitter:description" content="Insights on tech, programming, and productivity from a developer and quantitative thinker.">
  <meta name="twitter:site" content="@_jdn__">
  <meta name="twitter:creator" content="@_jdn__">

  <!-- Canonical URL -->
  <link rel="canonical" href="{{ url()->current() }}">

  <!-- Favicon -->
  <link rel="icon" href="https://www.jaydonlynch.dev/favicon.ico" type="image/x-icon">

  <style>
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
      text-decoration-color: #000 !important;
      color: #000 !important;
    }


    /* Container for category dropdown inside the search bar */
    .category-select {
      background-color: #000;
      color: #fff;
      border: 1px solid #444;
      padding: 10px;
      border-radius: 5px 0 0 5px;
      outline: none;
      max-width: 150px;
      /* Limit dropdown width */
      font-size: 0.9rem;
      text-align: center;
    }

    .category-select:focus {
      border-color: #888;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
    }

    /* Search Input */
    .search-input {
      background-color: #000;
      color: #fff;
      border: 1px solid #444 !important;
      border-left: none;
      /* Seamless transition with category dropdown */
      padding: 10px;
      border-radius: 0;
      outline: none;
      width: 100%;
      font-size: 1rem;
    }

    .search-input::placeholder {
      color: #bbb;
    }

    .search-input:focus {
      border-color: #888;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
    }

    /* Search Button */
    .search-btn {
      background-color: #000;
      color: #fff;
      border: 1px solid #444;
      border-left: none;
      padding: 10px 15px;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s, box-shadow 0.3s;
          border-top-left-radius: 0px !important;
    border-bottom-left-radius: 0px !important;
    }

    .search-btn:hover {
      background-color: #222;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
    }

    /* Mobile Adjustments */
    @media (max-width: 767px) {
      .category-select {
        max-width: 120px;
        /* Adjust dropdown width on smaller screens */
        font-size: 0.8rem;
      }

      .search-btn {
        padding: 10px;
        /* Adjust padding for smaller buttons */
        font-size: 0.9rem;
      }

      .search-input {
        font-size: 0.9rem;
      }
    }

    .category-select {
          border-right: 1px solid #000;
    border-left: none !important;
    border-top: none !important;
    border-bottom: none !important;
      display: block;
      max-width: 150px;
      /* Restricts the maximum width */
      background: transparent;
      color: #fff;
      padding: 10px;
      outline: none;
      font-size: 0.9rem;
      text-align: center;
      color: #000;
      overflow: hidden;
      /* Prevents overflow of long text */
      text-overflow: ellipsis;
      /* Adds '...' for overflowing text */
      white-space: nowrap;
      /* Ensures the text stays on one line */
      box-sizing: border-box;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .category-select:focus {
      border-color: #888;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    /* Hover for desktop users */
    .category-select:hover {
      cursor: pointer;
    }

    /* Optional - adjust for different screen sizes */
    @media (max-width: 767px) {
      .category-select {
        max-width: 4rem;
        /* Allows flexibility on small screens */
        font-size: 0.8rem;
      }
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

  <!-- Message if a post is posted successfully -->
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
  @endif

  <!-- Search Bar and Sort Dropdown -->
  <div class="container mt-4">
    <div class="row">
      <!-- Search Bar with Embedded Category Dropdown -->
      <div class="col-12">
        <form action="{{ route('blog') }}" method="GET" class="position-relative">
          <!-- Search Input -->
          <div class="d-flex" style="    border: 1px solid;
    border-radius: 7px;">
            <!-- Category Dropdown Inside -->
            <div class="input-group-prepend">
              <select name="category"  class="category-select" onchange="this.form.submit()">
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All</option>
                @foreach($categories as $cat => $count)
          <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
            {{ $cat }} ({{ $count }})
          </option>
        @endforeach
              </select>

            </div>
            <input type="text" name="search" style="border: none !important" class="form-control search-input" placeholder="Search posts by title..."
              value="{{ request('search') }}">
            <!-- Search Button -->
            <button type="submit" class="btn search-btn" style="background-color: #000; color:#fff; margin-left: 1rem">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>





  <div class="d-flex flex-wrap justify-content-evenly blog-container mt-4">
    @if (count($posts) > 0)
    @foreach ($posts as $post)
    <div class="blog-inner-container">
      @guest
    @else
      <div class="admin-items-container">
      <div class="admin-edit">
      <a class="nav-link" href="/edit-post/{{$post->id}}"><i class="fa-solid fa-pencil"></i></a>
      </div>
      <div class="admin-delete">
      <a class="nav-link" href="/delete/{{$post->id}}"><i class="fa-solid fa-trash"></i></a>
      </div>
      </div>
    @endguest
      <blog-card id="{{$post->id}}" title="{{$post->title}}" image="{{ asset('images/' . $post->image)}}"
      categories="{{$post->category}}" blogHTML="{{ $post->blogHTML }}"
      date="{{date_format(date_create($post->created_at), "M j, Y")}}"></blog-card>
    </div>
  @endforeach
    <div class="paginate-container">
      {{$posts->links()}}
    </div>

  @else
  <p>No Posts found</p>
@endif
  </div>

  @endsection

  <script>
    // JavaScript to handle the loading indicator
    window.addEventListener('load', function () {
      document.getElementById('loading-indicator').style.display = 'none';
    });
  </script>
</body>

</html>