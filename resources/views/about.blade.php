<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - JL</title>
<!-- Title and Description -->
<meta name="description"
  content="Discover insights, tips, and resources on tech, programming, and productivity. Explore the journey of a developer and creator passionate about innovation and growth.">

<!-- Keywords -->
<meta name="keywords"
  content="Jaydon Lynch, web development, Rust, JavaScript, CSS, Python, productivity, coding tips, programming, web design, tech insights">

<!-- Author -->
<meta name="author" content="Jaydon Lynch">

<!-- Thumbnail -->
<meta name="thumbnail" content="{{ asset('images/j-train.jpg') }}" />

<!-- Open Graph / Facebook -->
<meta property="og:title" content="Jaydon Lynch: A Developer and Creator">
<meta property="og:description"
  content="Exploring the intersection of life and productivity, I share insights as a developer and creator. From coding and creative projects to practical tips for living a balanced, productive life, my journey is all about growth, innovation, and inspiring others.">
<meta property="og:image" content="{{ asset('images/j-train.jpg') }}" />
<meta property="og:url" content="https://jaydonlynch.dev">
<meta property="og:type" content="website">
</head>

<body>
  @extends('layouts.app')

  @section('content')
  <div class="about-container">
    <span class="about">
      <b>I'm Jaydon – a developer and creator.</b>
      <br><br>

I began my journey making websites and implementing solutions for businesses, but over time, I’ve expanded into a mix of things—from building applications and exploring blockchain technology to creating tutorials on coding and finance. I also make YouTube content that dives into tech, business, and crypto. <br><br>Along the way, I’ve embraced the intersection of life and productivity, sharing insights as a developer and creator. From coding and creative projects to practical tips for living a balanced, productive life, my journey is focused on growth, innovation, and inspiring others. Born in Jamaica and raised in the U.S., I’m passionate about bringing creativity and innovation into every project I work on.<br><br>I post every last Saturday of the month.






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
