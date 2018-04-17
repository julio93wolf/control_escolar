<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Clase;
use App\Models\Estudiante;
use App\Models\Kardex;
use App\Models\Reticula;

class GrupoStoreRequest extends FormRequest
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
        /*
        $estudiante = Estudiante::find($this->estudiante_id);
        $clase = Clase::find($this->clase_id);

        $reticula = Reticula::where([
            ['asignatura_id',$clase->asignatura_id],
            ['plan_especialidad_id',$estudiante->plan_especialidad_id],
        ])->first();

        $requisitos = $reticula->requisitos;
        
        $this->requisitos = true;

        foreach ($requisitos as $key_requisito => $requisito) {

            $kardexs = Kardex::where([
                ['estudiante_id',$estudiante->id],
                ['asignatura_id',$requisito->asignatura_id]
            ])->get();

            if($kardexs){
                $max_calificacion = 0;

                foreach ($kardexs as $key_kardex => $kardex) {
                    if($kardex->calificacion >= $max_calificacion){
                        $max_calificacion = $kardex->calificacion;
                    }
                }

                if ($max_calificacion < 7) {
                    $this->requisitos = false;
                }

            }else{
                $this->requisitos = false;
            }

        }*/

        //dd($this->requisitos);

        $this->requisitos = false;

        $rules = [
            'requisitos'        => 'accepted',
            'clase_id'          => 'required|integer|min:1',
            'estudiante_id'     => 'required|integer|min:1',
            'oportunidad_id'    => 'required|integer|min:1'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'clase_id.required'         => 'La clase es requerida',
            'clase_id.integer'          => 'La clase tiene que ser un número entero',
            'clase_id.min'              => 'La clase mínima es 1.',

            'estudiante_id.required'    => 'El estudiante es requerido.',
            'estudiante_id.integer'     => 'El estudiante tiene que ser un número entero.',
            'estudiante_id.min'         => 'El estudiante mínimos es 1.',

            'oportunidad_id.required'   => 'La oportunidad es requerida.',
            'oportunidad_id.integer'    => 'La oportunidad tiene que ser un número entero.',
            'oportunidad_id.min'        => 'La oportunidad mínima es 1.'
        ];
    }
}
