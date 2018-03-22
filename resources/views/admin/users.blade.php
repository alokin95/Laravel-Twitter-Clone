@extends('admin.admin')
    @section('title', 'User manipulation')
    @section('content')
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Picture</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><img src="{{asset('/images/profile/'.$user->picture->path)}}" width="50px" height="50px"></td>
                    {{--<td>{{$user->password}}</td>--}}
                    <td>{{$user->role_id}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td><a href="{{asset('/admin/users/'.$user->id)}}">Edit</a></td>
                    <td><a href="{{asset('/admin/users/'.$user->id.'/delete')}}">Delete</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @include('layouts.partials.errors')
        </div>
        <div class="container">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{isset($single) ? asset('/admin/users/'.$single->id.'/update') : asset('admin/users/insert')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Enter name" value="{{isset($single) ? $single->name : old('name')}}" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{isset($single) ? $single->email : old('name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="email" placeholder="Enter password" name="password" value="{{isset($single) ? $single->password : old('email')}}">
                    </div>
                </div>
                @if(isset($single))
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="picture">Picture:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="picture" name="picture">
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">RoleID:</label>
                    <select name="role">
                        <option value="0">Pick</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        @endsection