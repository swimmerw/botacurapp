<?php

namespace App;

use Carbon\Carbon;
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

    public function getHorarioSaunaAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
    public function getHorarioTinajaAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
    public function getHorarioMasajeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }

    public function getHoraFinSaunaAttribute()
    {
        return $this->calcularHoraFin($this->horario_sauna, ['Sauna', 'Saunas']);
    }

    public function getHoraFinTinajaAttribute()
    {
        return $this->calcularHoraFin($this->horario_tinaja, ['Tinaja', 'Tinajas']);
    }

    public function getHoraFinMasajeAttribute()
    {
        return $this->calcularHoraFin($this->horario_masaje, ['Masaje', 'Masajes']);
    }

    private function calcularHoraFin($horarioInicio, $nombreServicio)
    {

        $servicio = $this->reserva->programa->servicios->first(function ($servicio) use ($nombreServicio) {
            return in_array($servicio->nombre_servicio, $nombreServicio);
        });

        if ($horarioInicio && $servicio) {
            $horaInicio = Carbon::parse($horarioInicio);
            return $horaInicio->addMinutes($servicio->duracion)->format('h:i A');
        }

        return null;
    }

    //OTRAS OPERACIONES
}
