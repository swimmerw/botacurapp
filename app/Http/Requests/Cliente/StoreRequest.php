<?php

namespace App\Http\Requests\Cliente;

use App\Cliente;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return $this->user()->can('create', Cliente::class);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_cliente'=>['required', 'string', 'max:255'],
            'whatsapp_cliente'=>['max:12','string', 'nullable'],
            'instagram_cliente'=>['max:255', 'string','nullable'],
            'sexo'=>['in:Masculino,Femenino,na'],
            'correo'=>['required', 'string', 'email', 'max:255', 'unique:clientes']
        ];
    }

    public function messages()
    {
        return [
            'nombre_cliente.required' => 'El campo nombre es requerido',
            'correo.required'=>'Este campo es requerido',
            'correo.string'=>'El valor no es correcto',
            'correo.max'=>'Excede el limite de 255 caracteres',
            'correo.unique'=>'Este email ya esta registrado',
            'whatsapp_cliente.max'=>'Excede el máximo de 12 caracteres',
            'whatsapp_cliente.string'=>'La informacion puede ser alfanumerica',
            'instagram_cliente.string'=>'La informacion puede ser alfanumerica',
            'sexo.in'=>'Debe seleccionar una opcion'

        ];
    }
}
