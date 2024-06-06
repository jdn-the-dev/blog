@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Edit</h1>
  <section class="mt-3">
    <form method="post" action="/edit-post/{{$post->id}}" enctype="multipart/form-data">
      @csrf
      <!-- Error message when data is not inputted -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="card p-3">
        <label for="floatingInput">Title</label>
        <input class="form-control" type="text" name="title" value={{$post->title}}>
        <label for="floatingInput">Category</label>
        <input class="form-control" type="text" name="category" value={{$post->category}}>
        <label for="floatingTextArea">Content</label>
        <quill-editor placeholder="{{$post->blogHTML}}"></quill-editor>
        <input type="hidden" name="blogHTML" id="floatingTextarea">
        <label for="formFile" class="form-label">Add Image</label>
        <img src="" alt="" class="img-blog">
        <input class="form-control" type="file" name="image">
      </div>
      <button class="btn btn-secondary m-3">Save</button>
    </form>
  </section>
    
</div>
@endsection