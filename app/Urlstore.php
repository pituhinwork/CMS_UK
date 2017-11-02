<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urlstore extends Model
{
    //
    protected $fillable = [
        'url', 'clicks', 'actions', 'description', 'text', 'name', 'title', 'user_id'
    ];
}
