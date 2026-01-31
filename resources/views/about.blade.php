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
<meta name="thumbnail" content="{{ asset('images/closed-door.jpg') }}" />

<!-- Open Graph / Facebook -->
<meta property="og:title" content="Jaydon Lynch: A Developer and Creator">
<meta property="og:description"
  content="Exploring the intersection of life and productivity, I share insights as a developer and creator. From coding and creative projects to practical tips for living a balanced, productive life, my journey is all about growth, innovation, and inspiring others.">
<meta property="og:image" content="{{ asset('images/closed-door.jpg') }}" />
<meta property="og:url" content="https://jaydonlynch.dev">
<meta property="og:type" content="website">
</head>

<body>
  @extends('layouts.app')

@section('content')
  <div class="about-container">
    <span class="about">
      <b>Jaydon Lynch ~ Developer and Quantitative Thinker</b>
      <br><br>

      Today, my focus spans development and finance through hands-on projects and real-world problem solving. Along the way, I’ve leaned into the connection between work, productivity, and life as a developer - sharing insights that reflect both technical growth and personal discipline. Born in Jamaica and raised in the U.S., I bring creativity, curiosity, and a systems-driven mindset to everything I build.

      <br>

    <div></div>
    <br>
    <div class="brand-container">
      <div class="brand">
        <a href="https://www.total.dev/">
          <img src="{{ asset('images/total-logo.png') }}"
               alt="Total Development Lab">
          Total Development Lab
        </a>
      </div>
    </div>

    <div class="contact-section">
      <h3>Get in Touch</h3>
      <p>Have a question or want to collaborate? Feel free to reach out!</p>
      <a href="mailto:mail@jaydonlynch.dev" class="contact-link">
        mail@jaydonlynch.dev
      </a>
    </div>
  </div>
@endsection


  <style>
    .nav-item:hover {
      text-decoration-color: #000 !important;
      color: #000 !important;
    }
    .contact-section {
      margin-top: 3rem;
      padding: 2rem;
      text-align: center;
      border-top: 1px solid #eee;
    }

    .contact-section h3 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    .contact-link {
      display: inline-block;
      margin-top: 1rem;
      padding: 0.5rem 1rem;
      color: #000;
      text-decoration: none;
      border: 2px solid #000;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .contact-link:hover {
      background-color: #000;
      color: #fff;
    }
  </style>
</body>

</html>
