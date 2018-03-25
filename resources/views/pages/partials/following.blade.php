<div id="following" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                @if (count($user->following)==0)
                    This user does not follow anyone.
                @endif
                @foreach($user->following as $following)
                    <a href="{{asset('user/'.$following->id)}}">
                        <div class="follow">
                            <img src="{{asset('/images/profile/'.$following->picture->path)}}" alt="{{$following->picture->alt}}">
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
