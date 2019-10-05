<?php

namespace App;

use App\Activity;
use App\Structure;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	const PERSONA_MEMBER = 'true';
	const PERSONA_NO_MEMBER = 'false';

    protected $fillable = [
        'name', 'lastname','ci', 'address', 'gender',
        'phone', 'celphone', 'email', 'civil_status', 'date_birth', 'ocupations',
        'professions', 'desease', 'celula', 'member',
    ];

    public function isMember(){
    	return $this->member == Persona::PERSONA_MEMBER;
    }

    public function activities(){
        return $this->belongsToMany(Activity::class);
    }
    
    public function structures(){
        return $this->belongsToMany(Structure::class);
    }
}
