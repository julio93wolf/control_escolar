<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Models\Estudiante;
use App\Models\Asignatura;
use App\Models\Periodo;
use App\Models\FechaExamen;
use App\Models\DataTableModel;

class DataTableController extends Controller
{
    public function estudiantes(){
    	$estudiantes = DataTableModel::estudiantes();
    	return Datatables::of($estudiantes)->make(true);
    }

    public function asignaturas($reticula_id){
    	$asignaturas = Asignatura::where('reticula_id',$reticula_id);
    	return Datatables::of($asignaturas)->make(true);	
    }

    public function periodos(){
    	$periodos = Periodo::get();
    	return Datatables::of($periodos)->make(true);
    }

    public function fechas_examenes($periodo_id){
        $fechas_examenes = DataTableModel::fechas_examenes($periodo_id);
        return Datatables::of($fechas_examenes)->make(true);    
    }

}
