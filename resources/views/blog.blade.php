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
          <a class="nav-link" href="/edit-post/{{$post->id}}"><i class="fa fa-pencil-square-o"></i></a>
  
        </div>
        <div class="admin-delete">
          <a class="nav-link" href="/delete/{{$post->id}}"><i class="fa fa-trash-o"></i></a>
        </div>
      </div>
      @endguest
      <blog-card id="{{$post->id}}" title="{{$post->title}}" image="{{ asset('images/'.$post->image)}}" categories="{{$post->category}}" blogHTML="{{ $post->blogHTML }}"></blog-card>

    </div>
    @endforeach
  @else
    <p>No Posts found</p>
  @endif
</div>
@endsection