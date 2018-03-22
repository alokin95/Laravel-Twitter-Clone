<nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
        @if(auth()->check())
            <ul class="navbar-nav">
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    @if(auth()->user()->role->id == '2')
                        @foreach($links->where('role_id','2') as $link)
                            <li class="nav-item">
                                <a class="nav-link" href="{{asset('/'.$link->href)}}">{{$link->title}}</a>
                            </li>
                        @endforeach
                    @else
                        @foreach($links as $link)
                            <li class="nav-item">
                                <a class="nav-link" href="{{asset('/'.$link->href)}}">{{$link->title}}</a>
                            </li>
                @endforeach
                @endif
            </ul>
        @endif
    </div>
    </div>
</nav>