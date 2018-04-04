<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataTableModel extends Model
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
}
