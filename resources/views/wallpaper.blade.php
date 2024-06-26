@extends('layouts.app')
@section('content')


<div class="d-flex flex-wrap justify-content-center">
  @if (count($images) > 0)
    @foreach ($images as $image)
    <div style="width: 300px">
      <img src="{{ asset('images/' . $image)}}" alt="" srcset="" width="300" height="300">
      <a class="btn resource-btn" style="width:100%" href="{{ asset('images/' . $image)}}" download="proposed_file_name"><i class="fa fa-download"></i> Download</a>
    </div>

  @endforeach
  @else
    <p>No Wallpaper found</p>
  @endif
</div>
@endsection