<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FechaExamenStoreRequest extends FormRequest
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
            'tipo_examen_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'periodo_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tipo_examen_id.required' => 'El tipo de examen es requerido',
            'fecha_inicio_submit.required' => 'La fecha de inicio es requerida',
            'fecha_inicio_submit.date' => 'El dato tiene que ser una fecha',
            'fecha_final_submit.required' => 'El tipo de examen es requerido',
            'fecha_final_submit.date' => 'El dato tiene que ser una fecha',
            'periodo_id.required' => 'El periodo es requerido'
        ];
    }
}
