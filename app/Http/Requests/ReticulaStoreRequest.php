<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReticulaStoreRequest extends FormRequest
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
            'especialidad_id'       => 'required|integer|min:1',
            'asignatura_id'         => 'required|integer|min:1',
            'periodo_especialidad'  => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'especialidad_id.required'          => 'La especialidad es requerida',
            'especialidad_id.integer'           => 'La especialidad tiene que ser un número entero',
            'especialidad_id.min'               => 'La especialidad tiene que ser mínimo 1',

            'asignatura_id.required'            => 'La asignatura es requerida',
            'asignatura_id.integer'             => 'La asignatura tiene que ser un número entero',
            'asignatura_id.min'                 => 'La asignatura tiene que ser mínimo 1',

            'periodo_especialidad.required'     => 'El período de especialidad es requerida',
            'periodo_especialidad.integer'      => 'La período de especialidad tiene que ser un número entero',
            'periodo_especialidad.min'          => 'La período de especialidad tiene que ser mínimo 1'
        ];
    }
}
