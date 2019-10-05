<?php

namespace App;

use App\Persona;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'name', 'description', 'chief',
    ];
}
