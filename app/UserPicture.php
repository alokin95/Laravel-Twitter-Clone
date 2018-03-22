<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPicture extends Model
{
    protected $guarded = [];
    protected $table = 'user_picture';

    public function user()
    {

        return $this->belongsTo(User::class);

    }
}
