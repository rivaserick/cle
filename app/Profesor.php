<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $guarded = [];    

    public function actualizaciones()
    {
        return $this->hasMany('App\Actualizacion', 'id_profesor');
    }
}
