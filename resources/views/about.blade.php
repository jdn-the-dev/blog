<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - JL</title>
</head>

<body>
  @extends('layouts.app')

  @section('content')
  <div class="about-container">
    <span class="about">
      <b>I'm Jaydon – a developer and creator.</b>
      <br><br>
      I began my journey crafting websites and implementing solutions for businesses, but over time, I’ve expanded into a mix of things—from building applications and exploring blockchain technology to creating tutorials on coding and finance. I also make YouTube content that dives into tech, business, and crypto. Born in Jamaica and raised in the U.S., I’m passionate about bringing innovation and creativity into every project I work on.</span>
    <div></div>
    <br>
    <div class="previous-title"><span>Previous work at:</span></div>
    <div class="brand-container">
      <div class="brand"><a href="https://www.microsoft.com/en-us/about"><img src="{{ asset('images/microsoft.png') }}"
            alt="microsoft-logo" srcset="">Microsoft</a></div>
      <div class="brand"><a href="https://www.carnegiehall.org/About"><img
            src="{{ asset('images/The-Carnegie-Hall-Logo.png') }}" alt="carnegie-hall-logo" srcset="">Carnegie Hall</a>
      </div>
      <div class="brand"><a href="https://www.pasadenaplayhouse.org/about/"><img src="{{ asset('images/pp-logo.png') }}"
            alt="pasadena-playhouse-logo" srcset=""><br>Pasadena Playhouse</a></div>
      <div class="brand"><a href="https://k12.sfsymphony.org/About-SFS"><img src="{{ asset('images/sf-symphony.png') }}"
            alt="san-franciso-symphony-logo" srcset="" width="" height="">San Francisco Symphony</a></div>
      <div class="brand"><a href="https://www.total.dev/"><img src="{{asset('images/total-logo.png')}}"
            alt="pasadena-playhouse-logo" srcset="">Total Developers</a></div>
    </div>

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
