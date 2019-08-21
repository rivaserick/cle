<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actualizacion extends Model
{
    //
    public function profesor()
    {
        return $this->belongsTo('App\Profesor', 'id_profesor');
    }
    
    public function periodo()
    {
        return $this->belongsTo('App\Period', 'id_periodo');
    }

    public function linea()
    {
        return $this->belongsTo('App\LineaCapacitacion', 'id_linea_capacitacion');
    }

    public function sublinea()
    {
        return $this->belongsTo('App\SublineaCapacitacion', 'id_sublinea_capacitacion');
    }

    public function status()
    {
        return $this->belongsTo('App\Status', 'id_status');
    }
}
