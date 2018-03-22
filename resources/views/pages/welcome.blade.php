@extends('layouts.layout')

@section('title', 'Welcome')

@section('content')

    <div class="container-fluid">

        <div class="row content">

            <div class="col-md-6 register">

                @include('layouts.partials.errors')

                <form method='post' action='welcome/register' class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-lg-3 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" onkeyup="mail();" placeholder="Email" name="email"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                   name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-3 control-label">Confirm password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password_confirmation"
                                   placeholder="Repeat password" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-default" name="register">Register</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6 login">

                <form class="form-horizontal" role="form" method="POST" action="welcome/login">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="inputEmail1" placeholder="Email" name="email"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label" required>Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputPassword1" placeholder="Password"
                                   name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>

                </form>

                @if(session('Message'))
                    {{session('Message')}}
                @endif

            </div>
        </div>

    </div>

@endsection
<script src="{{asset('/js/script.js')}}"></script>