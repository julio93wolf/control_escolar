<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignaturaUpdateRequest extends FormRequest
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
            'asignatura'    => 'required',
            'codigo'        => 'required|unique:asignaturas,codigo,'.$this->id,
            'creditos'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'codigo.unique' => 'El codigo ya ha sido utilizado',
        ];
    }
}
