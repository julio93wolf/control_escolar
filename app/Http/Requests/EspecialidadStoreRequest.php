<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadStoreRequest extends FormRequest
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
            'nivel_academico_id'        => 'required|integer',
            'especialidad'              => 'required',
            'clave'                     => 'required|unique:especialidades,clave',
            'periodos'                  => 'required|integer|min:1',
            'modalidad_id'              => 'required|integer',
            'tipo_plan_especialidad_id' => 'required|integer',
            'reconocimiento_oficial'    => 'required|unique:especialidades,reconocimiento_oficial',
            'fecha_reconocimiento'      => 'required|date',
            'dges'                      => 'required|unique:especialidades,dges'
        ];
    }

    public function messages()
    {
        return [
            'nivel_academico_id.required'           => 'El nivel academico es requerido',
            'nivel_academico_id.integer'            => 'El valor debe ser un número entero positivo',
            'especialidad.required'                 => 'El nombre de la especialidad es requerido',
            'clave.required'                        => 'La clave es requerida',
            'clave.unique'                          => 'La clave ya esta en uso',
            'periodos.required'                     => 'El número de periodos es requerido',
            'periodos.integer'                      => 'El número de periodos no es un numero entero',
            'periodos.min'                          => 'El número de periodos debe ser mayor a 0',
            'modalidad_id.required'                 => 'La modalidad es requerida',
            'modalidad_id.integer'                  => 'El valor debe ser un número entero positivo',
            'tipo_plan_especialidad_id.required'    => 'El tipo de plan es requerido',
            'tipo_plan_especialidad_id.integer'     => 'El valor debe ser un número entero positivo',
            'reconocimiento_oficial.required'       => 'El reconocimiento oficial es requerido',
            'reconocimiento_oficial.unique'         => 'El reconocimiento oficial ya esta en uso',
            'fecha_reconocimiento.required'         => 'La fecha de reconocimiento es requerida',
            'fecha_reconocimiento.date'             => 'Tiene que ingresar una fecha',
            'dges.required'                         => 'El DGES es requerido',
            'dges.unique'                           => 'El DGES ya esta en uso'
        ];
    }
}
