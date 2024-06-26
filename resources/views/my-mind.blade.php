
@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @auth
            <!-- The user is authenticated. -->
            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                </div>
            </form>
    
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        @endauth
        <h1 class="text-center">My mind</h1>
                <hr>
        @php
            function randomHeight() {
                return rand(150, 300); // Random height between 150px and 450px
            }
        @endphp

<div class="grid-my-mind">
    @foreach ($images as $index => $image)
        @php
            $height = randomHeight();
            $rowSpan = ceil($height / 10); // Calculate row span based on the random height and base row height
        @endphp
        <div class="grid-item-my-mind" style="grid-row-end: span {{ $rowSpan }};">
            <img src="{{ Storage::url($image->path) }}" alt="Image" style="height: {{ $height }}px; object-fit: cover;">
        </div>
    @endforeach
</div>
    </div>
@endsection

