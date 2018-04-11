<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataTable extends Model
{
    static function estudiantes(){
    	return \DB::table('vw_estudiantes');
  	}

  	static function fechas_examenes($periodo_id){
    	return \DB::table('vw_fechas_examenes')->where('periodo_id',$periodo_id)->get();
  	}

		static function especialidades(){
	    return \DB::table('vw_especialidades')->orderBy('id','desc')->get();
	  }  	

	  static function docentes(){
	    return \DB::table('vw_docentes')->orderBy('docente_id','desc')->get();
	  }

	  static function clases($periodo_id,$especialidad_id){
	    return \DB::table('vw_clases')->where([
	    	['periodo_id',						$periodo_id],
	    	['especialidad_id',	$especialidad_id]
	    ])->get();
	  }
}
