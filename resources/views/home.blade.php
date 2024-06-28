<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - JL</title>
    <style>
        body {
            background: url("{{ asset('images/white-trees.jpg') }}") no-repeat 50% fixed;
            background-size: cover;
        }
        .navbar-brand{
            color: #fff !important;
        }
        .nav-link {
            color: #fff !important;
        }
        .navbar-toggler-icon{
            background-color: #fff !important;
        }
        .navbar-toggler-icon::after{
            background-color: #fff !important;
        }
        .navbar-toggler-icon::before{
            background-color: #fff !important;
        }
        @media (max-width: 768px) {
            .nav-link {
                color: #000 !important;
            }
        }
    </style>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>
    </div>
    @endsection


</body>
</html>