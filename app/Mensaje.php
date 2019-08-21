<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'mensaje'
    ];

    public function actualizacion()
    {
        return $this->belongsTo('App\Actualizacion', 'id_actualizacion');
    }
}
