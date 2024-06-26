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
            function randomHeight()
            {
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
                                <img src="{{ Storage::url($image->path) }}" alt="Image" style="height: {{ $height }}px; object-fit: cover;" onclick="openModal('{{ Storage::url($image->path) }}')">
                            </div>
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
        /* Modal styles */
        /* Grid and Modal styles */
        .grid-my-mind {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }

        .grid-item-my-mind img {
            width: 100%;
            cursor: pointer;
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 60px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.9); 
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* Media queries for responsive design */
        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
            }

            .close {
                font-size: 30px;
                right: 25px;
                top: 10px;
            }
        }

        @media (max-width: 480px) {
            .modal-content {
                width: 95%;
            }

            .close {
                font-size: 25px;
                right: 20px;
                top: 5px;
            }
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