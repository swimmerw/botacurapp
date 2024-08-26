<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sectores';

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
