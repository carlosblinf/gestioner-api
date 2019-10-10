<?php

namespace App;

use App\Activity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    const USER_ACTIVED = 'true';
    const USER_NOT_ACTIVED = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'password', 'admin', 'actived',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setNameAttribute($valor){
        $this->attributes['name'] = strtolower($valor);
    }
    public function getNameAttribute($valor){
        return ucwords($valor);
    }
    public function setNicknameAttribute($valor){
        $this->attributes['nickname'] = strtolower($valor);
    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }
    public function isActived(){
        return $this->actived == User::USER_ACTIVED;
    }

    public function activities(){
        return $this->hasMany(Activity::class);
    }
}
