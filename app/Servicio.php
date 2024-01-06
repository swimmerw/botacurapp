<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre_servicio', 'valor_servicio','costo_servicio'
    ];


//RELACIONES
public function programa()
{
    return $this->belongsTo('App\Programa');
}

public function reservaciones()
{
    return $this->belongsToMany('App\Reserva');
}

//ALMACENAMIENTO

//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES

}