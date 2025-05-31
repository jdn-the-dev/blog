{{-- resources/views/literature_philosophy.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        {{-- Page Header --}}
        <div class="text-center mb-4">
            <h1>Literature &amp; Philosophy Picks</h1>
            <p class="lead">
                Discover our curated selection of essential reads. Click any link to purchase through our affiliate
                partners.
            </p>
        </div>

        {{-- Banner Image or Artwork --}}
        <div class="row mb-5">
            <div class="col-12 text-center">
                <img src="{{ asset('images/lit_philo_banner.jpg') }}" alt="Literature and Philosophy Banner"
                    class="img-fluid rounded shadow-sm">
            </div>
        </div>

        {{-- Two Columns: Literature | Philosophy --}}
        <div class="row">
            {{-- Literature Section --}}
            <div class="col-md-6 mb-4">
                <h2 class="mb-3">Literature</h2>
                <div class="list-group">
                    {{-- Item #1 --}}
                    <div class="list-group-item py-4">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('images/literature/book1.jpg') }}" alt="The Great Novel"
                                class="flex-shrink-0 mr-3 rounded" style="width: 80px; height: auto;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">The Great Novel</h5>
                                <p class="mb-2">
                                    An enduring classic that explores the human condition through unforgettable characters
                                    and prose.
                                </p>
                                <a href="https://www.amazon.com/dp/XXXXXXXXXX?tag=your-affiliate-id" target="_blank"
                                    rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                    Buy on Amazon
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Item #2 --}}
                    <div class="list-group-item py-4">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('images/literature/book2.jpg') }}" alt="Modern Poetry Collection"
                                class="flex-shrink-0 mr-3 rounded" style="width: 80px; height: auto;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Modern Poetry Collection</h5>
                                <p class="mb-2">
                                    A carefully curated anthology featuring groundbreaking poets of the 20th and 21st
                                    centuries.
                                </p>
                                <a href="https://www.amazon.com/dp/YYYYYYYYYY?tag=your-affiliate-id" target="_blank"
                                    rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                    Buy on Amazon
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Item #3 --}}
                    <div class="list-group-item py-4">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('images/literature/book3.jpg') }}" alt="Masterpiece Anthology"
                                class="flex-shrink-0 mr-3 rounded" style="width: 80px; height: auto;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Masterpiece Anthology</h5>
                                <p class="mb-2">
                                    A compilation of world‐changing literature—novels, essays, and short stories that
                                    defined eras.
                                </p>
                                <a href="https://www.example.com/affiliate/link3" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-sm btn-primary">
                                    Shop Affiliate
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- ...add more literature items as needed --}}
                </div>
            </div>

            {{-- Philosophy Section --}}
            <div class="col-md-6 mb-4">
                <h2 class="mb-3">Philosophy</h2>
                <div class="list-group">
                    {{-- Item #1 --}}
                    <div class="list-group-item py-4">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('images/philosophy/book1.jpg') }}" alt="Foundations of Western Philosophy"
                                class="flex-shrink-0 mr-3 rounded" style="width: 80px; height: auto;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Foundations of Western Philosophy</h5>
                                <p class="mb-2">
                                    An essential introduction to philosophical thought from the pre-Socratics to modern day.
                                </p>
                                <a href="https://www.amazon.com/dp/ZZZZZZZZZZ?tag=your-affiliate-id" target="_blank"
                                    rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                    Buy on Amazon
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Item #2 --}}
                    <div class="list-group-item py-4">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('images/philosophy/book2.jpg') }}" alt="Eastern Philosophical Classics"
                                class="flex-shrink-0 mr-3 rounded" style="width: 80px; height: auto;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Eastern Philosophical Classics</h5>
                                <p class="mb-2">
                                    A selection of pivotal texts—from Taoist to Buddhist teachings—that shaped Eastern
                                    thought.
                                </p>
                                <a href="https://www.example.com/affiliate/link4" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-sm btn-primary">
                                    Shop Affiliate
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Item #3 --}}
                    <div class="list-group-item py-4">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('images/philosophy/book3.jpg') }}" alt="Contemporary Ethics & Modern Life"
                                class="flex-shrink-0 mr-3 rounded" style="width: 80px; height: auto;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Contemporary Ethics &amp; Modern Life</h5>
                                <p class="mb-2">
                                    A deep dive into ethical dilemmas of the 21st century—technology, environment, and
                                    society.
                                </p>
                                <a href="https://www.amazon.com/dp/AAAAAAAAAA?tag=your-affiliate-id" target="_blank"
                                    rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                    Buy on Amazon
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- ...add more philosophy items as desired --}}
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Optional Custom CSS (you can move this to your main CSS file) --}}
@push('styles')
    <style>
        /* Ensure banner image has a nice drop shadow */
        .img-fluid.rounded.shadow-sm {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Adjust spacing inside list-group items */
        .list-group-item {
            border: none;
            border-bottom: 1px solid #e0e0e0;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        h2 {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 0.5rem;
        }
    </style>
@endpush