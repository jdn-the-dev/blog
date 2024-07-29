<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wallpaper - JL</title>
</head>
<body>
  @extends('layouts.app')
  @section('content')
  
  
  <div class="d-flex flex-wrap justify-content-center">
    @if (count($images) > 0)
    @foreach ($images as $image)
    <div class="free-wallpaper" style="width: 300px; margin:1rem">
      <img src="{{ asset('images/' . $image)}}" alt="" srcset="" width="300" height="250">
      <a class="btn resource-btn" style="width:100%" href="{{ asset('images/' . $image)}}"
      download="proposed_file_name"><i class="fa fa-download"></i> Download</a>
    </div>

  @endforeach
  @else
  <p>No Wallpaper found</p>
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

