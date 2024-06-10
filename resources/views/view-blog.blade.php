@extends('layouts.app')

@section('content')
<style>

</style>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h2 style="font-size: 32px">{{$post->title}}</h2>
        <h4 class="d-flex flex-row align-items-center justify-content-center" style="font-size: 14px">{{date_format(date_create($post->created_at), "M j, Y")}} <div> &nbsp;&nbsp;<i class="fa fa-eye" style="font-size: 12px"></i> {{$post->view_count}}</div></h4>
    </div>
    <section class="blog-content">
        {!! str_replace('class="ql-code-block"','style="width:80vw;background-color: #000; color: #fff; padding: 2rem; border-radius: 1rem"',$post->blogHTML)  !!}
    </section>
@endsection