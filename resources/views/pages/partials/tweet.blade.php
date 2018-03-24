<a href="{{asset('user/'.$tweet->user->id)}}">

                                <span class="profile-icon">

                                    <img src="{{asset('/images/profile/'.$tweet->user->picture->path)}}"
                                         alt="{{$tweet->user->picture->alt}}">

                                </span>{{$tweet->user->name }}

</a>

{{Carbon\Carbon::now()->parse($tweet->created_at)->diffForHumans()}}

<div class="post row">
    <div class='col-lg-8 tweet-body'>
        {{$tweet->body}}
    </div>

    <div class="col-lg-4">

        @if (auth()->id() == $tweet->user_id)
            <a class="btn btn-danger" href="{{asset('/delete/'.$tweet->id)}}">Delete</a>
        @endif
        <a href="#mymodal-{{$tweet->id}}" id='{{$tweet->id}}' role="button" value='test'
           class="btn btn-info show-comments" data-toggle="modal">View comments</a>

        @if ($tweet->numberOfComments()==1)
            {{$tweet->numberOfComments()}} comment
        @elseif ($tweet->numberOfComments()>1)
            {{$tweet->numberOfComments()}} comment
        @else
            0 Comments
        @endif
        <br/>
    </div>
    @include('pages.partials.comment')
</div>
<div class="rates">
    @if(auth()->user()->ratings()->where('rating_id', $tweet->id)->exists())
        <div class="rating">
            <i>Rating: {{number_format((float)$tweet->rating->sum/$tweet->rating->number_of_votes, 1, '.', '')}}</i>
        </div>

    @else
        <div class="rating" id="rating">
            <button class='vote' id='{{$tweet->id}}' value='5'>☆</button>
            <button class='vote' id='{{$tweet->id}}' value='4'>☆</button>
            <button class='vote' id='{{$tweet->id}}' value='3'>☆</button>
            <button class='vote' id='{{$tweet->id}}' value='2'>☆</button>
            <button class='vote' id='{{$tweet->id}}' value='1'>☆</button>
        </div>
    @endif
</div>
<hr>