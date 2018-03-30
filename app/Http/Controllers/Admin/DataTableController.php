<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Models\Estudiante;
use App\Models\Asignatura;
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
}
