<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tweet extends Model
{

    protected $guarded = [];


    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function comments()
    {

        return $this->hasMany(Comment::class);

    }

    public function rating()
    {

        return $this->hasOne(Rating::class);

    }

    public function latestTweets()
    {

        return $this->with('user')->orderBy('created_at', 'desc')->paginate(5);

    }


    public function numberOfComments()
    {

        return $this->comments->where('tweet_id', $this->id)->count();

    }


    public function addComment($comment)
    {

        $this->comments()->create(['body' => $comment, 'user_id' => auth()->id()]);

    }
}