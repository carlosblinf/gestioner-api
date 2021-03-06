<?php

namespace App;

use App\Activity;
use App\Structure;
use App\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    protected $dates = ['delete_at'];
    
	const PERSONA_MEMBER = 'true';
	const PERSONA_NO_MEMBER = 'false';

    protected $fillable = [
        'name', 'lastname','ci', 'address', 'gender',
        'phone', 'celphone', 'email', 'civil_status', 'date_birth', 'ocupations',
        'professions', 'desease', 'celula', 'member', 'department_id',
    ];
    
    public function setEmailAttribute($valor){
        $this->attributes['email'] = strtolower($valor);
    }

    public function isMember(){
    	return $this->member == Persona::PERSONA_MEMBER;
    }

    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function activities(){
        return $this->belongsToMany(Activity::class);
    }
    
    public function structures(){
        return $this->belongsToMany(Structure::class);
    }
}
