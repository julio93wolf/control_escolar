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
            'especialidad_id'       => 'required|integer',
            'asignatura_id'         => 'required|integer',
            'periodo_especialidad'  => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'especialidad_id.required'          => 'La especialidad es requerida',
            'especialidad_id.integer'           => 'El valor debe ser un número entero positivo',
            'asignatura_id.required'            => 'La asignatura es requerida',
            'asignatura_id.integer'             => 'El valor debe ser un número entero positivo',
            'periodo_especialidad.required'     => 'La asignatura es requerida',
            'periodo_especialidad.integer'      => 'El valor debe ser un número entero positivo'
        ];
    }
}
