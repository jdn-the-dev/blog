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
      Hello there!<br><br>
      I’m <b>Jaydon James Amal Lynch</b>, a web developer at <a href="https://www.theclearinghouse.org/About/Owner-Banks">The Clearing House</a>. Welcome to my little corner of the internet!<br><br>
      Here, I share thoughts and tips on <b>creativity</b>, <b>coding</b>, <b>crypto</b>, and the tools and strategies that make a programmer's life smoother and more exciting.<br><br>
      I’m also an <b>INFJ-T</b> personality type!<br><br>
      And if you're looking for fresh content, I publish a new blog post every month on the <b>last Saturday</b>. There’s always something new to explore, so feel free to check back often!
    </span>
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
