<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Mind - JL</title>
</head>
<body>
    <div id="loading-indicator">
        <div class="spinner">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    @extends('layouts.app')
@section('content')
    
    <div class="container mt-5">
        @auth
            <!-- The user is authenticated. -->
            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" style="margin:4rem">
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
        <div class="container-my-mind">
            <div class="image"></div>
            <div class="image"></div>
            <div class="image"></div>
            <div class="button">My Mind</div>
        </div>

        <div class="grid-my-mind">
            @foreach ($images as $index => $image)
                        <my-mind-card img="{{ Storage::url($image->path) }}"></my-mind-card>
            @endforeach
        </div>

        <!-- Modal Structure -->
        <div id="lightboxModal" class="modal" onclick="closeModal(event)">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="lightboxImage">
            @if(isset($image) && isset($image->created_at))
                <div class="lightbox-modal-date">Date: {{ date('F j, Y', strtotime($image->created_at)) }}</div>
            @else
                <div class="lightbox-modal-date">Date: N/A</div>
            @endif
        </div>
    </div>
@endsection

    <style>
        .nav-item:hover{
            text-decoration-color: #000 !important;
            color: #000 !important;
        }
    </style>
    <script>
        function openModal(imageSrc) {
            var modal = document.getElementById("lightboxModal");
            var modalImg = document.getElementById("lightboxImage");
            modal.style.display = "block";
            modalImg.src = imageSrc;
        }

        function closeModal() {
            var modal = document.getElementById("lightboxModal");
            if (event.target === modal || event.target.className === 'close') {
                modal.style.display = "none";
            }
        }
                // JavaScript to handle the loading indicator
                window.addEventListener('load', function() {
          document.getElementById('loading-indicator').style.display = 'none';
        });
    </script>
</body>
</html>
