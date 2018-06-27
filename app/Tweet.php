<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;

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


    public static function latestTweets()
    {
        $followed_users = User::find(auth()->user()->id)->following->pluck('id');

        $followed_tweets = self::whereIn('user_id', $followed_users)->orWhere('user_id',auth()->user()->id)->orderBy('tweets.created_at','desc')->paginate(10);

        return $followed_tweets;
    }

    public function numberOfComments()
    {

        return $this->comments->where('tweet_id', $this->id)->count();

    }


    public function addComment($comment)
    {

       $comm = $this->comments()->create(['body' => $comment, 'user_id' => auth()->id()]);


       return Comment::with('user')->where('id','=',$comm['id'])->first();

    //    return User::find(auth()->user()->id)->with(['comments' => function ($query) use ($comm) {
    //         $query->where('id', '=', $comm['id']);
    //     }])->first();
    }
}