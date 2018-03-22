@extends('admin.admin')

@section('title', 'Tweets manipulation')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Body</th>
                <th>Author</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tweets as $tweet)
                <tr>
                    <td>{{$tweet->id}}</td>
                    <td>{{$tweet->body}}</td>
                    <td>{{$tweet->user->name}}</td>
                    <td>{{$tweet->created_at}}</td>
                    <td>{{$tweet->updated_at}}</td>
                    <td><a href="{{asset('/admin/tweets/'.$tweet->id)}}">Edit</a></td>
                    <td><a href="{{asset('/admin/tweets/'.$tweet->id.'/delete')}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('layouts.partials.errors')
    </div>
    <div class="container">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{isset($single) ? asset('/admin/tweets/'.$single->id.'/update') : asset('admin/tweets/insert')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Tweet:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tweet" placeholder="Enter tweet" value="{{isset($single) ? $single->body : old('name')}}" name="tweet">
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