<?php

namespace App\Http\Requests\Admin\Clase;

use App\Models\Clase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $clases = [];
        $clases_registradas = Clase::where([
            ['asignatura_id',$this->asignatura_id],
            ['especialidad_id',$this->especialidad_id],
            ['periodo_id',$this->periodo_id],
            ['id','<>',$this->clase_id]
        ])->get();
        foreach ($clases_registradas as $key => $clase_registrada) {
            array_push($clases,$clase_registrada->clase);
        }

        $rules = [
            'clase'             => [
                'required',
                Rule::notIn($clases)
            ],
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

        if($this->dia){
            foreach ($this->dia as $key => $dia_value) {
                $rule = [ 'hora_inicio.'.$dia_value  => 'date_format:H:i' ];
                $rules = array_merge($rules,$rule);
                $rule = [ 'hora_salida.'.$dia_value  => 'date_format:H:i|after:hora_inicio.'.$dia_value ];
                $rules = array_merge($rules,$rule);
            }    
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'clase.required'            => 'La clase es requerida.',
            'clase.not_in'              => 'El nombre de la clase ya está en uso.',

            'asignatura_id.required'    => 'La asignatura es requerida.',
            'asignatura_id.integer'     => 'La asignatura tiene que ser un número entero.',
            'asignatura_id.min'         => 'La asignatura mínima es 1.',

            'docente_id.required'       => 'El docente es requerido.',
            'docente_id.integer'        => 'El docente tiene que ser un número entero.',
            'docente_id.min'            => 'El docente mínimo es 1.',

            'periodo_id.required'       => 'El período es requerido.',
            'periodo_id.integer'        => 'El período tiene que ser un número entero.',
            'periodo_id.min'            => 'El período mínimo es 1.',

            'especialidad_id.required'  => 'La especialidad es requerida.',
            'especialidad_id.integer'   => 'La especialidad tiene que ser un número entero.',
            'especialidad_id.min'       => 'La especialidad mínima es 1.'
        ];
    }
}
