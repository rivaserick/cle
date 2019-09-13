<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;
    
    public function profesor()
    {
        return $this->belongsTo('App\Profesor', 'id_profesor');
    }

    public function observaciones()
    {
        return $this->hasMany('App\Observacion', 'id_grupo');
    }
}
