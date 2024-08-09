<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wallpaper - JL</title>
  <style>
    .nav-item:hover {
      text-decoration-color: #000 !important;
      color: #000 !important;
    }

    /* Lightbox Styles */
    .lightbox {
      display: none;
      position: fixed;
      z-index: 9999;
      padding-top: 60px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.9);
    }

    .lightbox-content {
      margin: auto;
      display: block;
      width: 90%;
      height: 80%;
      max-width: 700px;
    }

    .lightbox-close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }

    .lightbox-close:hover,
    .lightbox-close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }

    /* Add Animation */
    .lightbox-content {
      animation-name: zoom;
      animation-duration: 1s;
    }

    @keyframes zoom {
      from {transform: scale(0)} 
      to {transform: scale(1)}
    }

    @media only screen and (max-width: 700px){
      .lightbox-content {
        width: 80%;
        margin-top: 2rem;
      }
    }
  </style>
</head>
<body>
  @extends('layouts.app')
  @section('content')

  <div class="d-flex flex-wrap justify-content-center">
    @if (count($images) > 0)
        @foreach ($images as $image)
      <div class="free-wallpaper" style="width: 300px; margin:1rem">
      <img src="{{ asset('wallpaper/' . $image)}}" alt="" srcset="" width="300" height="250" class="thumbnail" onclick="openLightbox('{{ asset('wallpaper/' . $image)}}')">
      <div class="wallpaper-resource-actions" style="margin-top: 0.4rem">
      <a class="btn resource-btn" style="width:50%; background-color: #d2dae2" onclick="openLightbox('{{ asset('wallpaper/' . $image)}}')">
      <i class="fa fa-eye"></i> View
      </a>
      <a class="btn resource-btn" style="width:50%" href="{{ asset('wallpaper/' . $image)}}" download="{{$image}}">
      <i class="fa fa-download"></i> Download
      </a>
      </div>

      </div>
      @endforeach
  @else
    <p>No Wallpaper found</p>
    @endif
  </div>

  <!-- The Modal/Lightbox -->
  <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
  </div>

  @endsection

  <script>
    function openLightbox(imageSrc) {
      document.getElementById('lightbox-img').src = imageSrc;
      document.getElementById('lightbox').style.display = "block";
    }

    function closeLightbox(event) {
      const lightbox = document.getElementById('lightbox');
      if (event.target == lightbox || event.target.className == 'lightbox-close') {
        lightbox.style.display = "none";
      }
    }
  </script>
</body>
</html>
