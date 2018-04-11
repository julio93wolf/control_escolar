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
use App\Models\DataTable;

class DataTableController extends Controller
{
    public function estudiantes(){
    	$estudiantes = DataTable::estudiantes();
    	return Datatables::of($estudiantes)->make(true);
    }

    public function asignaturas(){
    	$asignaturas = Asignatura::orderBy('id','desc')->get();
    	return Datatables::of($asignaturas)->make(true);	
    }

    public function periodos(){
    	$periodos = Periodo::orderBy('id','desc')->get();
    	return Datatables::of($periodos)->make(true);
    }

    public function fechas_examenes($periodo_id){
        $fechas_examenes = DataTable::fechas_examenes($periodo_id);
        return Datatables::of($fechas_examenes)->make(true);    
    }

    public function especialidades(){
        $especialidades = DataTable::especialidades();
        return Datatables::of($especialidades)->make(true);
    }

    public function docentes(){
        $docentes = DataTable::docentes();
        foreach ($docentes as $key => $docente) {
            $fecha_nacimiento = new \DateTime($docente->fecha_nacimiento);
            $today = new \DateTime(date("Y-m-d"));
            $edad = $fecha_nacimiento->diff($today);
            $docente->edad = $edad->y;
        }
        return Datatables::of($docentes)->make(true);
    }

    public function clases(Request $request){
        $clases = DataTable::clases($request->periodo_id,$request->especialidad_id);
        return Datatables::of($clases)->make(true);
    }
}
