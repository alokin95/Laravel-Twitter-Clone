@extends('admin.admin')

@section('title', 'Comments manipulation')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Comment</th>
                <th>Author</th>
                <th>Tweet</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->body}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->tweet->body}}</td>
                    <td>{{$comment->created_at}}</td>
                    <td>{{$comment->updated_at}}</td>
                    <td><a href="{{asset('/admin/comments/'.$comment->id)}}">Edit</a></td>
                    <td><a href="{{asset('/admin/comments/'.$comment->id.'/delete')}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('layouts.partials.errors')
    </div>
    <div class="container">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{isset($single) ? asset('/admin/comments/'.$single->id.'/update') : asset('admin/comments/insert')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="comment">Comment:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="comment" placeholder="Enter comment" value="{{isset($single) ? $single->body : old('name')}}" name="comment">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="tweet">Tweet:</label>
                <div class="col-sm-10">
                   <select name="tweet" id="tweet">
                       <option value="0">Select tweet...</option>
                       @foreach($tweets as $tweet)
                           <option value="{{$tweet->id}}">{{$tweet->body}}</option>
                           @endforeach
                   </select>
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