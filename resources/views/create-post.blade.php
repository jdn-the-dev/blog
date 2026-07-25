@extends('layouts.app')

@section('title', 'Create post')

@section('content')
<div class="container py-4">
    <header class="mb-4">
        <p class="text-uppercase small mb-1">Admin</p>
        <h1>Create post</h1>
    </header>
    <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        @include('partials.post-form')
    </form>
</div>
@endsection
