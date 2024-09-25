<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'id_visita',
        'id_producto_entrada',
        'id_producto_fondo',
        'id_producto_acompanamiento',
        'observacion',
    ];

    // RELACIONES
    public function visita(){
        return $this->belongsTo(Visita::class);
    }
}
