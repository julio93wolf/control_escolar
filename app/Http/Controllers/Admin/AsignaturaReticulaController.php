<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
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
					array_push($response,$asignatura);
				}
			}
      return $response;
    }
}
