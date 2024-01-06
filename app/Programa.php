<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;

class Programa extends Model
{
    protected $guarded = [];  

//RELACIONES
    public function servicios()
    {
        return $this->hasMany('App\Servicio');
    }

    public function reservaciones()
    {
        return $this->belongsToMany('App\Reserva');
    }
    
//ALMACENAMIENTO

public function store($request)
{

    //dd($request);
    $slug = Str::slug($request->nombre_programa, '-');
    Alert::success('Éxito', 'Programa guardado')->showConfirmButton();
    return self::create($request->all() + [
        'slug' => $slug,
    ]);
}



public function my_update($request)
{
    $slug = Str::slug($request->nombre_programa, '-');
    Alert::success('Éxito', 'Programa actualizado')->showConfirmButton();
    return self::update($request->all() + [
        'slug' => $slug,
    ]);
    
}
//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES

}
