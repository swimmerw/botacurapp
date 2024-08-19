<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre_cliente', 'whatsapp_cliente','instagram_cliente','sexo','correo'
    ];




//RELACIONES
public function reservas()
{
    return $this->hasMany('App\Reserva');
}



//ALMACENAMIENTO

//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES
    
}
