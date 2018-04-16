<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaStoreRequest extends FormRequest
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
            'empresa' => 'required|unique:empresas,empresa',
        ];
    }

    public function messages()
    {
        return [
            'empresa.required'  => 'La empresa es requerida',
            'empresa.unique'    => 'La empresa ya ha está registrada'
        ];
    }

}
