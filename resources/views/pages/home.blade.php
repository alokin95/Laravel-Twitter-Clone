@extends('layouts.layout')

@section('title', 'Home')

@section('content')

    <div class="container">

        <div class="jumbotron">

            <div class="row content">

                <div class="col-lg-3 sidenav">
                    <div class="jumbotron user">
                        <a href="{{asset('/user/'.auth()->user()->id)}}"><img
                                    src="{{ asset('images/profile/'.auth()->user()->picture->path)}}"
                                    alt="{{auth()->user()->picture->alt}}">
                            <p>{{auth()->user()->name}}</p>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 posts tweets">

                    @include('layouts.partials.errors')

                    <div class="form-group">
                        <form action="{{asset('/tweets')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="tweets">
                                <div class="form-group">
                                    <label for="tweet"><b>Tweet:</b></label>
                                    <input type="text" class="form-control" id="tweet" placeholder="What's happening?"
                                           name="tweet">
                                </div>
                                <button type="submit" class="btn btn-success">Tweet it!</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="blog-main">
                        @foreach($tweets as $tweet)

                            @include('pages.partials.tweet')

                        @endforeach
                        <div class="links">
                            {{$tweets->links()}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 sidenav">
                    <div class="jumbotron popular">
                        <p><strong>Who to follow:</strong></p>
                        @foreach($users as $user)
                            <a href="{{asset('/user/'.$user->id)}}">
                                <img src="{{asset('/images/profile/'.$user->picture->path)}}" alt="{{$user->picture->alt}}" {{ $user->name }} >
                                {{$user->name}}
                            </a>
                            <br/>
                        @endforeach
                        {{--{{$users->links()}}--}}
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection

@section('script')

    <script src="{{asset('/js/script.js')}}"></script>

@endsection