<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = [];    
    
    public function actualizaciones()
    {
        return $this->hasMany('App\Actualizacion', 'id_periodo');
    }
}
