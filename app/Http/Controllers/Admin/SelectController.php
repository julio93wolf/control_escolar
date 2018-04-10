<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
use App\Models\PlanEspecialidad;
use App\Models\Reticula;
use App\Models\Asignatura;
use App\Models\Localidad;
use App\Models\Municipio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{
    public function especialidades_nivel($nivel_academico_id){
    	$especialidades = Especialidad::where('nivel_academico_id',$nivel_academico_id)->get();
    	return $especialidades;
    }

    public function planes_especialidades($especialidad_id){
        $planes_especialidades = PlanEspecialidad::where('especialidad_id',$especialidad_id)->get();
        return $planes_especialidades;
    }

    public function reticulas($especialidad_id){
    	$reticulas = Reticula::where('especialidad_id',$especialidad_id)->get();
    	return $reticulas;
    }

	public function asignaturas_reticula($plan_especialidad_id){
    	$response = [];
    	$plan_especialidad = PlanEspecialidad::find($plan_especialidad_id);
    	$asignaturas_plan = $plan_especialidad->asignaturas;
    	$asignaturas = Asignatura::get();

    	foreach ($asignaturas as $key => $asignatura) {
    		$find = false;
    		foreach ($asignaturas_plan as $key => $asignatura_plan) {
    			if($asignatura->id == $asignatura_plan->id){
    				$find = true;
    			}
    		}
    		if(!$find){
    			array_push($response,$asignatura);
    		}
    	}
    	return $response;
    }    

    public function asignaturas_requisito($reticula_id){
        $response = [];

        $reticula = Reticula::find($reticula_id);
        $requisitos = $reticula->requisitos;

        $plan_especialidad = PlanEspecialidad::find($reticula->plan_especialidad_id);
        $asignaturas_plan = $plan_especialidad->asignaturas;

        foreach ($asignaturas_plan as $key => $asignatura_plan) {
            
            if($asignatura_plan->id != $reticula->asignatura_id){
                $pivot = $asignatura_plan->pivot;
                if($pivot->periodo_reticula < $reticula->periodo_reticula){
                    $match = false;
                    foreach ($requisitos as $key => $requisito) {
                        $asignatura_requisito = $requisito->asignatura;
                        if($asignatura_plan->id == $asignatura_requisito->id){
                            $match = true;
                        }
                    }
                    if(!$match){
                        $reticula_asignatura = Reticula::where([
                            ['plan_especialidad_id',$pivot->plan_especialidad_id],
                            ['asignatura_id',$pivot->asignatura_id],
                            ['periodo_reticula',$pivot->periodo_reticula]
                        ])->first();
                        $asignatura_plan->reticula = $reticula_asignatura->id;
                        array_push($response,$asignatura_plan);    
                    }
                }       
            }        
        }
        return $response;
    }

    public function municipios($estado_id){
        $municipios = Municipio::where('estado_id',$estado_id)->orderBy('municipio','asc')->get();
        return $municipios;
    }

    public function localidades($municipio_id){
        $localidades = Localidad::where('municipio_id',$municipio_id)->orderBy('localidad','asc')->get();
        return $localidades;
    }    
}
