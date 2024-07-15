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
        <div class="container-my-mind">
            <div class="image"></div>
            <div class="image"></div>
            <div class="image"></div>
            <div class="button">My Mind</div>
        </div>

        <div class="grid-my-mind">
            @foreach ($images as $index => $image)
                        @php
                            $height = 300;
                        @endphp
                        <my-mind-card img="{{ Storage::url($image->path) }}" height="{{ $height }}"></my-mind-card>
                        <!--div class="grid-item-my-mind" style="grid-row-end: span {{ $rowSpan }};">
                            <img src="{{ Storage::url($image->path) }}" alt="Image" style="height: {{ $height }}px; object-fit: cover;" onclick="openModal('{{ Storage::url($image->path) }}')">
                        </div-->
            @endforeach
        </div>

        <!-- Modal Structure -->
        <div id="lightboxModal" class="modal" onclick="closeModal(event)">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="lightboxImage">
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
    </script>