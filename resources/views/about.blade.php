@extends('layouts.app')

@section('content')
  <div class="about-container">
    <span class="about">
      Hello!<br><br>
      My name is <b>Jaydon James Amal Lynch</b>. I'm currenly a web developer at <a
        href="https://www.theclearinghouse.org/About/Owner-Banks">The Clearing House</a>. <br><br>
      On this site, I talk about creativity, code, crypto, as well as
      some tools and strategies to help programmers navigate the world.
      <br><br>
      Personality Type: <b>INFJ-T</b>
    </span>
    <div></div>
    <div class="previous-title"><span>Previous work at</span></div>
    <div class="brand-container">
      <div class="brand"><a href="https://www.microsoft.com/en-us/about"><img src="{{ asset('images/microsoft.png') }}"
            alt="microsoft-logo" srcset="">Microsoft</a></div>
      <div class="brand"><a href="https://www.carnegiehall.org/About"><img src="{{ asset('images/The-Carnegie-Hall-Logo.png') }}"
            alt="carnegie-hall-logo" srcset="">Carnegie Hall</a></div>
      <div class="brand"><a href="https://www.pasadenaplayhouse.org/about/"><img src="{{ asset('images/pp-logo.png') }}"
            alt="pasadena-playhouse-logo" srcset=""><br>Pasadena Playhouse</a></div>
      <div class="brand"><a href="https://k12.sfsymphony.org/About-SFS"><img src="{{ asset('images/sf-symphony.png') }}"
            alt="san-franciso-symphony-logo" srcset="" width="" height="">Sanfranciso Symphony</a></div>
      <div class="brand"><a href="https://www.total.dev/"><img src="{{asset('images/total-logo.png')}}"
            alt="pasadena-playhouse-logo" srcset="">Total Developers</a></div>
    </div>
    
  </div>
@endsection