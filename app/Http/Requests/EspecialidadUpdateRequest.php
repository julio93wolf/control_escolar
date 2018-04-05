<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadUpdateRequest extends FormRequest
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
            'nivel_academico_id'        => 'required|integer|min:1',
            'especialidad'              => 'required',
            'clave'                     => 'required|unique:especialidades,clave,'.$this->id,
            'periodos'                  => 'required|integer|min:1',
            'modalidad_id'              => 'required|integer|min:1',
            'tipo_plan_especialidad_id' => 'required|integer|min:1',
            'reconocimiento_oficial'    => 'required|unique:especialidades,reconocimiento_oficial,'.$this->id,
            'fecha_reconocimiento'      => 'required|date',
            'dges'                      => 'required|unique:especialidades,dges,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'nivel_academico_id.required'           => 'El nivel académico es requerido',
            'nivel_academico_id.integer'            => 'El nivel académico tiene que ser un número entero',
            'nivel_academico_id.min'                => 'El nivel académico tiene que ser mínimo 1',

            'especialidad.required'                 => 'El nombre de la especialidad es requerido',

            'clave.required'                        => 'La clave es requerida',
            'clave.unique'                          => 'La clave ya está en uso',

            'periodos.required'                     => 'El número de periodos es requerido',
            'periodos.integer'                      => 'El número de periodos tiene que ser un numero entero',
            'periodos.min'                          => 'El número de periodos tiene que ser mínimo 1',

            'modalidad_id.required'                 => 'La modalidad es requerida',
            'modalidad_id.integer'                  => 'La modalidad tiene que ser un número entero',
            'modalidad_id.min'                      => 'La modalidad tiene que ser mínimo 1',

            'tipo_plan_especialidad_id.required'    => 'El tipo de plan es requerido',
            'tipo_plan_especialidad_id.integer'     => 'El tipo de plan tiene que ser un número entero',
            'tipo_plan_especialidad_id.min'         => 'El tipo de plan tiene que ser mínimo 1',

            'reconocimiento_oficial.required'       => 'El reconocimiento oficial es requerido',
            'reconocimiento_oficial.unique'         => 'El reconocimiento oficial ya está en uso',

            'fecha_reconocimiento.required'         => 'La fecha de reconocimiento es requerida',
            'fecha_reconocimiento.date'             => 'Tiene que ingresar una fecha',

            'dges.required'                         => 'El DGES es requerido',
            'dges.unique'                           => 'El DGES ya está en uso'
        ];
    }
}

