@extends('layouts.layout')

@section('content')
<div class="container jumbotron">
@foreach($about as $a)
        <p>{{$a->about}}</p>
        <img src="{{asset('/'.$a->path)}}" alt="{{$a->alt}}" width="300px" height="400px">
    @endforeach
</div>
    @endsection
