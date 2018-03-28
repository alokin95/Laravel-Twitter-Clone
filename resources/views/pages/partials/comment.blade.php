<div id="mymodal-{{$tweet->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                {{--TWEET BEGIN--}}
                <a href="{{asset('user/'.$tweet->user->id)}}">

                                <span class="profile-icon">

                                    <img src="{{asset('/images/profile/'.$tweet->user->picture->path)}}"
                                         alt="{{$tweet->user->picture->alt}}">

                                </span>{{$tweet->user->name }}

                </a>

                {{Carbon\Carbon::now()->parse($tweet->created_at)->diffForHumans()}}

                <div class='tweet-body'>
                    {{$tweet->body}}
                </div>
                {{--TWEET END--}}

                <hr>
                <div class="form-group">
                    <form class="form-inline" method="POST" action="{{asset('/comments/'.$tweet->id)}}">
                        {{ csrf_field() }}
                        <input type="text" name="comment" id='comment' class="form-control input-sm"
                               placeholder="Type your response here">
                        <input type="hidden" value="{{$tweet->id}}" id="hidden-id">
                        <button type="submit" id="add-comment" class="btn btn-info">Submit</button>
                    </form>
                </div>
                <div class="form-group">
                    <div class="response-comments" id="tweetid_{{$tweet->id}}">

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>