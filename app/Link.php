<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function links()
    {
        return static::with('role')->orderBy('order','asc')->get();
    }
}
