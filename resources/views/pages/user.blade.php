@extends('layouts.layout')

@section('title', $user->name)

@section('content')

    <div class="container">

        <div class="jumbotron">

            <div class="user-nav">

                {{--FOLLOWERS BUTTON AND MODAL--}}
                <a href="#following-{{$user->id}}">
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#following">Following</button>
                </a>
                @include('pages.partials.following')
                {{--FOLLOWERS END--}}

                {{--FOLLOWING BUTTON AND MODAL--}}
                <a href="#following-{{$user->id}}">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#followers">Followers</button>
                </a>

                @include('pages.partials.follower')
                {{--FOLLOWING END--}}

                @if($user->id != auth()->user()->id)
                    @if(!auth()->user()->following->contains($user))
                        <a href="{{asset('/follow/'.$user->id)}}">
                            <button class="btn btn-success">Follow</button>
                        </a>
                    @else
                        <a href="{{asset('unfollow/'.$user->id)}}">
                            <button value="{{$user->id}}" class="btn btn-danger">Unfollow</button>
                        </a>
                    @endif
                @endif

            </div>
            <div class="row content">
                <div class="user-image col-md-5">
                    {{$user->name}}
                    <hr>
                    <img src="{{asset('images/profile/'.$user->picture->path)}}" alt="{{$user->picture->alt}}">

                    @if($user->id == auth()->user()->id)

                        <form action="{{asset('/user')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input id="uploadFile" placeholder="Choose File" disabled="disabled" />
                            <div class="fileUpload btn btn-primary">
                                <span>Browse...</span>
                                <input id="uploadBtn" type="file" class="upload" name="picture"/>
                            </div>
                            <button type="submit">Change picture</button>
                        </form>
                    @endif

                </div>
                <div class="offset-1"></div>
                <div class="col-md-6 user-tweet">

                    @include('layouts.partials.errors')

                    @if($user->id == auth()->user()->id)
                        <form action="{{asset('/tweets')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="col-lg-12 posts tweets">
                                <div class="form-group">
                                    <label for="tweet">Tweet:</label>
                                    <input type="text" class="form-control" id="tweet" placeholder="What's happening?" name="tweet">
                                </div>
                                <button type="submit" class="btn btn-success">Tweet it!</button>
                            </div>
                        </form>
                        <hr>
                    @endif

                    @if(count($user->tweets)==0)
                        <div class="text-center no-tweets">
                            User has not tweeted anything yet.
                        </div>
                    @else
                        @foreach($user->tweets as $tweet)

                            @include('pages.partials.tweet')

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="{{asset('/js/script.js')}}"></script>

@endsection

