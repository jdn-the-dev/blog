<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - JL</title>
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
      border: 2px solid #3498db;
      border-radius: 50%;
      animation: spinner 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
      border-color: #3498db transparent transparent transparent;
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

  <div class="d-flex flex-wrap justify-content-evenly blog-container">
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
    @else
      <p>No Posts found</p>
    @endif
  </div>

  @endsection

  <script>
    // JavaScript to handle the loading indicator
    window.addEventListener('load', function() {
      document.getElementById('loading-indicator').style.display = 'block';
    });
  </script>
</body>
</html>
