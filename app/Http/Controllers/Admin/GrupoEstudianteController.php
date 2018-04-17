<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Clase;
use App\Models\Oportunidad;
use App\Models\Kardex;

class GrupoEstudianteController extends Controller
{
    public function get(Request $request){

    	$response = null;

    	$estudiante = Estudiante::where([
    		['matricula',$request->matricula],
    		['especialidad_id',$request->especialidad_id]
    	])->first();

    	if ($estudiante) {

    		$estudiante_grupo = Grupo::where([
    			['clase_id',$request->clase_id],
    			['estudiante_id',$estudiante->id]
    		])->first();

    		if (!$estudiante_grupo) {

    			$clase = Clase::find($request->clase_id);
    			$reticulas = $estudiante->plan_especialidad->reticulas;

    			$match_asignatura = false;

    			foreach ($reticulas as $key => $reticula) {
    				if ($reticula->asignatura_id == $clase->asignatura_id) {
    					$match_asignatura = true;
    				}
    			}

    			if($match_asignatura){

    				$kardexs = Kardex::where([
							['estudiante_id',$estudiante->id],
							['asignatura_id',$clase->asignatura_id]
						])->get();

	    			$oportunidades = Oportunidad::get();

						if( sizeof($kardexs) <= sizeof($oportunidades) ){

							$valid = true;
							foreach ($kardexs as $key => $kardex) {
								if ($kardex->calificacion >= 7) {
									$valid = false;
								}
							}

							if($valid){

								$no_oportunidad = sizeof($kardexs) + 1;
								$oportunidad = Oportunidad::find($no_oportunidad);
								$dato_general = $estudiante->dato_general;

	  						$response['estudiante_id'] = $estudiante->id;
	  						$response['semestre'] = $estudiante->semestre;
	  						$response['nombre'] = $dato_general->nombre.' '.$dato_general->apaterno.''.$dato_general->amaterno;
	  						$response['oportunidad_id'] = $oportunidad->id;
	  						$response['oportunidad'] = $oportunidad->oportunidad;
									
							}

						}

    			}

    		}

    	}

    	return $response;
    }
}
