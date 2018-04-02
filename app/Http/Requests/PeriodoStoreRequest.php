<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodoStoreRequest extends FormRequest
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
            'anio' => 'required',
            'periodo' => 'required',
            'reconocimiento_oficial' => 'required|unique:periodos,reconocimiento_oficial',
            'dges' => 'required|unique:periodos,dges',
            'fecha_reconocimiento_submit' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'reconocimiento_oficial.unique' => 'El reconocimiento ya ha sido utilizado',
            'dges.unique'  => 'El dges ya ha sido utilizado'
        ];
    }
}
