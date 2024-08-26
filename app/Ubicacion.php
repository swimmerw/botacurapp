<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{

    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre'
    ];


//RELACIONES
// public function programa()
// {
//     return $this->belongsTo('App\Programa');
// }

// public function reservaciones()
// {
//     return $this->belongsToMany('App\Reserva');
// }

//ALMACENAMIENTO

//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES
}
