<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaseStoreRequest extends FormRequest
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
        
        $rules = [
            'clase'             => 'required',
            'asignatura_id'     => 'required|integer|min:1',
            'docente_id'        => 'required|integer|min:1',
            'periodo_id'        => 'required|integer|min:1',
            'especialidad_id'   => 'required|integer|min:1',
            'dia'               => 'required|array',
            'dia.*'             => 'required|integer',
            'hora_inicio'       => 'required|array',
            'hora_inicio.*'     => 'required|date_format:H:i',
            'hora_salida'       => 'required|array',
            'hora_salida.*'     => 'required|date_format:H:i'
        ];


        foreach ($this->dia as $key => $dia_value) {
            $rule = [ 'hora_inicio.'.$dia_value  => 'date_format:H:i' ];
            $rules = array_merge($rules,$rule);
            $rule = [ 'hora_salida.'.$dia_value  => 'date_format:H:i|after:hora_inicio.'.$dia_value ];
            $rules = array_merge($rules,$rule);
        }

        return $rules;
    }
}
