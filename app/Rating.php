<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;

    public function tweet()
    {

        return $this->belongsTo(Tweet::class);

    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
