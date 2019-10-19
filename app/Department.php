<?php

namespace App;

use App\Persona;
use App\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
	use SoftDeletes;
    protected $dates = ['delete_at'];
    
    protected $fillable = [
        'name', 'description', 'chief',
    ];

    public function personas(){
    	return $this->hasMany(Persona::class);
    }
    
    public function activities(){
    	return $this->belongsToMany(Activity::class);
    }
}
