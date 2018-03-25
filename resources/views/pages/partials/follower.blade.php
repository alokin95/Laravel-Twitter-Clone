<div id="followers" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                @if (count($user->followers)==0)
                    This user does not have followers yet.
                @endif
                @foreach($user->followers as $follower)
                    <a href="{{asset('user/'.$follower->id)}}">
                        <div class="follow">
                            <img src="{{asset('/images/profile/'.$follower->picture->path)}}" alt="{{$follower->picture->alt}}">
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
