<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $guarded = [];
    
    public function profesor()
    {
        return $this->belongsTo('App\Profesor', 'id_profesor');
    }
}
