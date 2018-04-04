<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FechaExamenUpdateRequest extends FormRequest
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
            'tipo_examen_id'    => 'required',
            'fecha_inicio'      => 'required|date',
            'fecha_final'       => 'required|date|after_or_equal:fecha_inicio'
        ];
    }

    public function messages()
    {
        return [
            'tipo_examen_id.required'       => 'El tipo de examen es requerido',
            'fecha_inicio.required'         => 'La fecha de inicio es requerida',
            'fecha_inicio.date'             => 'El dato tiene que ser una fecha',
            'fecha_final.required'          => 'El tipo de examen es requerido',
            'fecha_final.date'              => 'El dato tiene que ser una fecha',
            'fecha_final.after_or_equal'    => 'La fecha final tiene que ser mayor o igual a la fecha de inicio'
        ];
    }
}
