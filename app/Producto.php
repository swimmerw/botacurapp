<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'valor',
        'estado',
        'id_tipo_producto'
    ];

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'insumo_producto')
                    ->withPivot('cantidad_insumo_usar', 'total_costo_producto', 'utilidad_producto')
                    ->withTimestamps();
    }

    public function detallesConsumos()
    {
        return $this->hasMany(DetalleConsumo::class, 'id_producto');
    }
}
