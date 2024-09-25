<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTransaccion extends Model
{
    protected $table = 'tipos_transacciones';

    protected $fillable = [
        'nombre'
    ];


//RELACIONES
public function ventas()
{
    return $this->hasMany(Venta::class);
}

// public function reservaciones()
// {
//     return $this->belongsToMany('App\Reserva');
// }

//ALMACENAMIENTO

//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES
}
