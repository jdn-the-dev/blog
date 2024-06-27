@extends('layouts.app')
@section('content')


<div class="d-flex flex-wrap justify-content-center">
  @if (count($images) > 0)
    @foreach ($images as $image)
    <div style="width: 300px">
      <img src="{{ asset('images/' . $image)}}" alt="" srcset="" width="300" height="300">
      <button class="btn" style="width:100%"><i class="fa fa-download"></i> Download</button>
    </div>
    
  @endforeach
  @else
    <p>No Wallpaper found</p>
  @endif
</div>
@endsection

    <style>
        .nav-item:hover{
            text-decoration-color: #000 !important;
            color: #000 !important;
        }
    </style>