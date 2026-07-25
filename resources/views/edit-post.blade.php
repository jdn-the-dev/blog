@extends('layouts.app')

@section('title', 'Edit '.$post->title)

@section('content')
<div class="container py-4">
    <header class="mb-4">
        <p class="text-uppercase small mb-1">Admin</p>
        <h1>Edit post</h1>
    </header>
    <form method="post" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('partials.post-form')
    </form>
</div>
@endsection
