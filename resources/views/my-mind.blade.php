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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>


        @endauth
        <div class="container-my-mind">
            <div class="image"></div>
            <div class="image"></div>
            <div class="image"></div>
            <div class="button">My Mind</div>
        </div>

        <div class="grid-my-mind">
            @foreach ($images as $index => $image)
                <my-mind-card img="{{ Storage::url($image->path) }}" date="{{ date('F j, Y', strtotime($image->created_at)) }}"></my-mind-card>
                @auth
                    <span class="delete-icon" onclick="deleteImage({{ $image->id }})">🗑️</span>
                @endauth
            @endforeach
        </div>

        <!-- Modal Structure -->
        <div id="lightboxModal" class="modal" onclick="closeModal(event)">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="lightboxImage">
            <div class="lightbox-modal-date" id="lightbox-modal-date">Date: </div>
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
        function closeModal() {
            var modal = document.getElementById("lightboxModal");
            if (event.target === modal || event.target.className === 'close') {
                modal.style.display = "none";
            }
        }
        @auth
            function deleteImage(imageId) {
                if (confirm('Are you sure you want to delete this image?')) {
                    fetch(`/delete-image/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => {
                            if (response.ok) {
                                window.location.reload();
                            } else {
                                alert('Failed to delete the image.');
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting image:', error);
                            alert('An error occurred while trying to delete the image.');
                        });
                }
            }
        @endauth
        // JavaScript to handle the loading indicator
        window.addEventListener('load', function() {
          document.getElementById('loading-indicator').style.display = 'none';
        });
    </script>
</body>
</html>
