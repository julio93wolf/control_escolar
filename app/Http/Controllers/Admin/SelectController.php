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
}
