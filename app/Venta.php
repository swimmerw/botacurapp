<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'abono_programa',
        'imagen_abono',
        'diferencia_programa',
        'imagen_diferencia',
        'descuento',
        'total_pagar',
        'id_reserva',
        'id_tipo_transaccion_abono',
        'id_tipo_transaccion_diferencia',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva');
    }
}
