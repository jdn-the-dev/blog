<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - JL</title>
</head>
<body>
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
  
  <style>
    .nav-item:hover {
      text-decoration-color: #000 !important;
      color: #000 !important;
    }
  </style>
</body>
</html>

