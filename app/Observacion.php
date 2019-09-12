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
}
