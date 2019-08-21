<?php

namespace App;

use App\Profesor;
use App\Coordinador;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profesor(){
        return $this->hasOne('App\Profesor', 'id_user');
    }

    public function coordinador (){
        return $this->hasOne('App\Coordinador', 'id_user');
    }

    public function clase () {
        if ($this->profesor) {
            return 1;
        } else if ($this->coordinador){
            return 3;
        }
        if($this->id==1){
            return 0;
        }
    }
}
