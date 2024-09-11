<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos';

    protected $fillable = [
        'nombre',
        'valor',
        'cantidad',
        'stock_critico',
        'id_unidad_medida',
        'id_sector'
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'insumo_producto')
                    ->withPivot('cantidad_insumo_usar', 'id_unidad_medida', 'total_costo_producto', 'utilidad_producto')
                    ->withTimestamps();
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'id_sector');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'id_unidad_medida');
    }
}
