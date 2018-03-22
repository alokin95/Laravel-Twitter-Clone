<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Rating;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function tweets()
    {

        return $this->hasMany(Tweet::class);

    }

    public function comments()
    {

        return $this->hasMany(Comment::class);

    }

    public function picture()
    {

        return $this->hasOne(UserPicture::class);

    }

    public function role()
    {

        return $this->belongsTo(Role::class);

    }

    public function following(){

        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');

    }

    public function followers(){

        return $this->belongsToMany(User::class,'followers', 'user_id', 'follower_id');

    }

    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }

    public function postTweet(Tweet $tweet)
    {
        $this->tweets()->save($tweet);

        Rating::create([
        'tweet_id' => $tweet->id,
        'sum' => 0,
        'number_of_votes' => 0
        ]);

    }
}
