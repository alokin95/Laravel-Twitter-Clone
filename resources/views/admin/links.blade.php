@extends('admin.admin')

@section('title', 'Links manipulation')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>RoleID</th>
                <th>Order</th>
                <th>Title</th>
                <th>Href</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($links as $link)
                <tr>
                    <td>{{$link->id}}</td>
                    <td>{{$link->role_id}}</td>
                    <td>{{$link->order}}</td>
                    <td>{{$link->title}}</td>
                    <td>{{$link->href}}</td>
                    <td>{{$link->created_at}}</td>
                    <td>{{$link->updated_at}}</td>
                    <td><a href="{{asset('/admin/links/'.$link->id)}}">Edit</a></td>
                    <td><a href="{{asset('/admin/links/'.$link->id.'/delete')}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        @include('layouts.partials.errors')
    </div>
    <div class="container">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{isset($single) ? asset('/admin/links/'.$single->id.'/update') : asset('admin/links/insert')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="role">Role:</label>
                <select name="role">
                    <option value="0">Select...</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->id}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="role">Order:</label>
                <input type="number" name="order" value="{{isset($single) ? $single->order : old('name')}}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" placeholder="Enter title" value="{{isset($single) ? $single->title : old('name')}}" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="href">Href:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="href" placeholder="Enter href" value="{{isset($single) ? $single->href : old('name')}}" name="href">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>


@endsection