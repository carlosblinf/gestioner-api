<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'description', 'dateStart', 'dateEnd', 'user_id',
    ];
}
