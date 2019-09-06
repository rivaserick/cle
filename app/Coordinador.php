<?php

namespace App;

use App\Profesor;
use App\Coordinador;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coordinador extends Authenticatable
{
    use Notifiable;

    protected $guard = 'coordinacion';

    protected $guarded = [];
}
