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
    public function servicios()
    {
        return $this->belongsToMany('App\Servicio');
    }

    public function programas()
    {
        return $this->belongsToMany('App\Programa');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
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
