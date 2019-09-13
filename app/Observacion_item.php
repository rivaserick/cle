<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion_item extends Model
{
    protected $guarded = [];    
    
    public function observacion()
    {
        return $this->belongsTo('App\Observacion', 'id_observacion');
    }
    
    public function item()
    {
        return $this->belongsTo('App\Item', 'id_item');
    } 
}
