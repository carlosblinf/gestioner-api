<?php

namespace App;

use App\User;
use App\Persona;
use App\Structure;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'description', 'dateStart', 'dateEnd', 'user_id',
    ];

    public function users(){
    	return $this->belongsTo(User::class);
    }

    public function personas(){
    	return $this->belongsToMany(Persona::class);
    }
    
    public function structures(){
    	return $this->belongsToMany(Structure::class);
    }

    public function departaments(){
        return $this->belongsToMany(Department::class);
    }
    
}
