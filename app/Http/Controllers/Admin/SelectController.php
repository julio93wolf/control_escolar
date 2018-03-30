<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
use App\Models\Reticula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{
    public function especialidades($nivel_academico_id){
    	$especialidades = Especialidad::where('nivel_academico_id',$nivel_academico_id)->get();
    	return $especialidades;
    }

    public function reticulas($especialidad_id){
    	$reticulas = Reticula::where('especialidad_id',$especialidad_id)->get();
    	return $reticulas;
    }
}
