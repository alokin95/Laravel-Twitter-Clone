<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function users()
    {

        return $this->hasMany(User::class);

    }

    public function links()
    {

        return $this->hasMany(Link::class);

    }
}
