<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $guarded = [];
    
    public function grupo()
    {
        return $this->belongsTo('App\Grupo', 'id_grupo');
    }

    public function observador()
    {
        return $this->belongsTo('App\Observador', 'id_observador');
    }

    public function observacion_items()
    {
        return $this->hasMany('App\Observacion_item', 'id_observacion');
    }
}
