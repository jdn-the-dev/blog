<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <head>
        <title>Resources - JL</title>
    </head>
</head>

<body>
    @extends('layouts.app')
    @section('content')


    <div class="d-flex flex-wrap justify-content-center resources-container">
        <resource-card title="Free Wallpaper" resource="wallpaper" icon="wallpaper_slideshow"></resource-card>
        <resource-card title="My Mind (Creativity)" resource="my-mind" icon="cognition"></resource-card>
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