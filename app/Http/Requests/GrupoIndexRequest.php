<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoIndexRequest extends FormRequest
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
            'clase' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'clase.required'   => 'La clase es requerida',
            'clase.integer'    => 'La clase tiene que ser un número entero',
            'clase.min'        => 'La clase tiene que ser mínimo 1'
        ];
    }
}
