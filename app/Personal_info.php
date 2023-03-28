<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal_info extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "fav_pairs" => "array",
    ];
    //
}
