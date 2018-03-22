<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = [];

    public function tweet()
    {

        return $this->belongsTo(Tweet::class);

    }

    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public static function showComments() {
        return static::where('tweet_id', request()->id)->with('tweet', 'user')->orderBy('created_at','desc')->get();
    }
}
