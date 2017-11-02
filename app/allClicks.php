<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class allClicks extends Model
{
    //
    protected $fillable = [
        'url_id', 'country'
    ];
}
