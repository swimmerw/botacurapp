<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Foundation\Http\FormRequest;

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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente_id'=>['required','exists:clientes,id'],
            'cantidad_personas'=>['required','integer','min:1'],
            'cantidad_masajes'=>['nullable','integer','min:0'],
            'fecha_visita'=>['date', 'nullable'],
            'observacion'=>['nullable', 'string', 'max:255'],

        ];
    }

    public function messages(){
        return [
            'cliente_id.required'=>'Cliente incorrecto, contactese con el administrador',
            'cantidad_personas.integer'=>'El campo solo acepta valores numéricos',
            'cantidad_masajes.integer'=>'El campo solo acepta valores numéricos',
            'fecha_visita.date' => 'El campo debe ser una fecha valida',
            'observacion.max'=>'Excede el máximo de caracteres permitidos'
        ];
    }
}
