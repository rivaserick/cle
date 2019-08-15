<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    //
    public function actualizacion()
    {
        return $this->hasOne('App\Actualizacion', 'id_periodo');
    }
}
