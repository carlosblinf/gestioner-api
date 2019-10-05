<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	const PERSONA_MEMBER = 'true';
	const PERSONA_NO_MEMBER = 'false';

    protected $fillable = [
        'name', 'lastname','ci', 'address', 'municipality', 'province', 'gender',
        'phone', 'celphone', 'email', 'civil_status', 'date_birth', 'ocupations',
        'professions', 'desease', 'celula', 'member', 'structure_id', 'activity_id',
    ];

    public function isMember(){
    	return $this->member == Persona::PERSONA_MEMBER;
    }
}
