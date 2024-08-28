<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;

class Reserva extends Model
{
    protected $fillable = [
        'cantidad_personas', 'fecha_visita', 'descripcion', 'cliente_id',
        'cantidad_masajes',
        'observacion',
        'user_id',
    ];

    //RELACIONES
    // public function programas()
    // {
    //     return $this->belongsToMany('App\Programa');
    // }

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'id_reserva');
    }

    public function reagendamientos()
    {
        return $this->hasMany(Reagendamiento::class, 'id_reserva');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

//ALMACENAMIENTO

    public function store($request)
    {
        if ($request->has('cliente_id')) {
            $cliente = $request->cliente_id;
            $request->merge(['cliente_id' => $cliente]);
        }

        $user_id = auth()->id();

        $request->merge(['user_id' => $user_id]);

        Alert::success('Exito', 'Reservación Realizada', 'Confirmar')->showConfirmButton();
        return self::create($request->all());
    }

//VALIDACION

//RECUPERACION DE INFORMACION
    public function getFechaVisitaAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

//OTRAS OPERACIONES

}
