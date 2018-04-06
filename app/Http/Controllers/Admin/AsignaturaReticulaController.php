<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
use App\Models\Reticula;
use App\Models\RequisitoReticula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsignaturaReticulaController extends Controller
{
    public function asignaturas_periodo(Request $request){
    	$response = [];
			$especialidad = Especialidad::find($request->especialidad_id);
			$asignaturas  = $especialidad->asignaturas;
			foreach ($asignaturas as $key => $asignatura) {
				if($asignatura->pivot->periodo_especialidad == $request->periodo_especialidad){
					$pivot = $asignatura->pivot;
					$reticula = Reticula::where([
						['asignatura_id',$pivot->asignatura_id],
						['especialidad_id',$pivot->especialidad_id],
						['periodo_especialidad',$pivot->periodo_especialidad],
						['tipo_plan_reticula_id',1]
					])->first();
					$asignatura->reticula = $reticula->id;
					array_push($response,$asignatura);
				}
			}
      return $response;
    }

    public function asignaturas_requisito($reticula_id){
    	$response = [];
			$reticula = Reticula::find($reticula_id);
			$asignaturas_requisito = $reticula->requisitos;

			
			foreach ($asignaturas_requisito as $key => $asignatura_requisito){
				
				$asignatura = $asignatura_requisito->asignatura;
				$asignatura->periodo_especialidad = $asignatura_requisito->periodo_especialidad;

				$pivot = $asignatura_requisito->pivot;
				$requisito = RequisitoReticula::where([
					['reticula_id',$pivot->reticula_id],
					['reticula_requisito_id',$pivot->reticula_requisito_id]
				])->first();
				$asignatura->requisito = $requisito->id;
				array_push($response,$asignatura);
			}
      return $response;
    }
}
