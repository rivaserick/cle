<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\Item', 'id_categoria');
    }
}
