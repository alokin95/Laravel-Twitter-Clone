@extends('admin.admin')

@section('title', 'Rating manipulation')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>TweetID</th>
                <th>Sum</th>
                <th>Times voted on</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ratings as $rating)
                <tr>
                    <td>{{$rating->id}}</td>
                    <td>{{$rating->tweet_id}}</td>
                    <td>{{$rating->sum}}</td>
                    <td>{{$rating->number_of_votes}}</td>
                    <td>{{$rating->created_at}}</td>
                    <td>{{$rating->updated_at}}</td>
                    <td><a href="{{asset('/admin/ratings/'.$rating->id)}}">Edit</a></td>
                    <td><a href="{{asset('/admin/ratings/'.$rating->id.'/delete')}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        @include('layouts.partials.errors')
    </div>
    <div class="container">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{isset($single) ? asset('/admin/ratings/'.$single->id.'/update') : asset('admin/ratings/insert')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="tweet">Tweet</label>
                <select name="tweet">
                    <option value="0">Select...</option>
                    @foreach($ratings as $rating)
                        <option value="{{$rating->tweet->id}}">{{$rating->tweet->id}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="sum">Rating sum:</label>
                <input type="number" name="sum" value="{{isset($single) ? $single->sum : old('name')}}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="number">Number of votes:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" placeholder="Enter num of votes" value="{{isset($single) ? $single->number_of_votes : old('name')}}" name="number">
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