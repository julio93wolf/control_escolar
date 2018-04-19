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
use App\Models\PlanEspecialidad;
use App\Models\DataTable;
use App\Models\EstadoEstudiante;
use App\Models\Titulo;
use App\Models\TipoExamen;
use App\Models\Oportunidad;
use App\Models\NivelAcademico;

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

    public function planes_especialidades($especialidad_id){
        $planes_especialidad = PlanEspecialidad::where('especialidad_id',$especialidad_id)->get();
        return Datatables::of($planes_especialidad)->make(true);
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

    public function kardex(Request $request){
        $kardex = DataTable::kardex($request->estudiante_id);
        return Datatables::of($kardex)->make(true);
    }

    public function grupos(Request $request){
        $grupo = DataTable::grupos($request->clase);
        return Datatables::of($grupo)->make(true);
    }

    public function estados_estudiantes(){
        $estados_estudiantes = EstadoEstudiante::get();
        return Datatables::of($estados_estudiantes)->make(true);
    }

    public function titulos_docentes(){
        $titulos = Titulo::get();
        return Datatables::of($titulos)->make(true);
    }

    public function tipos_examenes(){
        $tipos_examenes = TipoExamen::get();
        return Datatables::of($tipos_examenes)->make(true);
    }    

    public function oportunidades(){
        $oportunidades = Oportunidad::get();
        return Datatables::of($oportunidades)->make(true);
    } 

    public function niveles_academicos(){
        $niveles_academicos = NivelAcademico::get();
        return Datatables::of($niveles_academicos)->make(true);
    }
}
