<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $fillable = [
        'subtotal',
        'total_consumo',
        'id_venta',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function detallesConsumos()
    {
        return $this->hasMany(DetalleConsumo::class, 'id_consumo');
    }

    public function detallesServiciosExtra()
    {
        return $this->hasMany(DetalleServiciosExtra::class, 'id_consumo');
    }
}
