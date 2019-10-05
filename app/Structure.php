<?php

namespace App;

use App\Persona;
use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'name', 'description', 'chief',
    ];

    public function personas(){
    	return $this->belongsToMany(Persona::class);
    }
    
    public function activities(){
    	return $this->belongsToMany(Activity::class);
    }
}
