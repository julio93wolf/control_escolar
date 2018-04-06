<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
use App\Models\Reticula;
use App\Models\Asignatura;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{
    public function especialidades_nivel($nivel_academico_id){
    	$especialidades = Especialidad::where('nivel_academico_id',$nivel_academico_id)->get();
    	return $especialidades;
    }

    public function reticulas($especialidad_id){
    	$reticulas = Reticula::where('especialidad_id',$especialidad_id)->get();
    	return $reticulas;
    }

	public function asignaturas_especialidad($especialidad_id){
    	$response = [];
    	$especialidad = Especialidad::find($especialidad_id);
    	$asignaturas_especialidad = $especialidad->asignaturas;
    	$asignaturas = Asignatura::get();

    	foreach ($asignaturas as $key => $asignatura) {
    		$find = false;
    		foreach ($asignaturas_especialidad as $key => $asignatura_especialidad) {
    			if($asignatura->id == $asignatura_especialidad->id){
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

        $especialidad = Especialidad::find($reticula->especialidad_id);
        $asignaturas_especialidad = $especialidad->asignaturas;

        foreach ($asignaturas_especialidad as $key => $asignatura_especialidad) {
            
            if($asignatura_especialidad->id != $reticula->asignatura_id){
                $pivot = $asignatura_especialidad->pivot;
                if($pivot->periodo_especialidad <= $reticula->periodo_especialidad){
                    $match = false;
                    foreach ($requisitos as $key => $requisito) {
                        $asignatura_requisito = $requisito->asignatura;
                        if($asignatura_especialidad->id == $asignatura_requisito->id){
                            $match = true;
                        }
                    }
                    if(!$match){
                        $reticula_asignatura = Reticula::where([
                            ['especialidad_id',$pivot->especialidad_id],
                            ['asignatura_id',$pivot->asignatura_id],
                            ['periodo_especialidad',$pivot->periodo_especialidad],
                            ['tipo_plan_reticula_id',1],
                        ])->first();
                        $asignatura_especialidad->reticula = $reticula_asignatura->id;
                        array_push($response,$asignatura_especialidad);    
                    }
                }       
            }        
        }
        return $response;
    }    
}
