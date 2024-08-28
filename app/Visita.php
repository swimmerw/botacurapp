<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $fillable = [
        'horario_sauna',
        'horario_tinaja',
        'horario_masaje',
        'trago_cortesia',
        'alergias',
        'observacion',
        'id_reserva',
        'id_ubicacion',
        'id_lugar_masaje',
    ];

        //RELACIONES
    
        public function reserva()
        {
            return $this->belongsTo(Reserva::class, 'id_reserva');
        }

        public function ubicacion()
        {
            return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
        }

        public function lugarMasaje()
        {
            return $this->belongsTo(LugarMasaje::class, 'id_lugar_masaje');
        }


    
    //ALMACENAMIENTO
        
    //VALIDACION
    
    //RECUPERACION DE INFORMACION
        // public function getFechaVisitaAttribute($value)
        // {
        //     return Carbon::parse($value)->format('d-m-Y');
        // }
    
    //OTRAS OPERACIONES
}
