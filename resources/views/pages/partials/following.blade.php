<div id="following" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                @if (count($user->following)==0)
                    @if(empty(request()->user))
                        You are not following anyone.
                        @else
                            This user does not follow anyone.
                    @endif
                @else
                    @foreach($user->following as $following)
                        <a href="{{asset('user/'.$following->id)}}">
                            <div class="follow">
                                <img src="{{asset('/images/profile/'.$following->picture->path)}}" alt="{{$following->picture->alt}}">
                                {{$following->created_at}}
                                {{$following->name}}
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
