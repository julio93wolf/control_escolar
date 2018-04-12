<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clase;
use App\Models\NivelAcademico;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\Especialidad;
use App\Models\Dia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClaseCreateRequest;
use App\Http\Requests\ClaseStoreRequest;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.academicos.clases.index',[
            'niveles_academicos' => NivelAcademico::get(),
            'periodos'           => Periodo::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClaseCreateRequest $request)
    {
        $especialidad = Especialidad::find($request->especialidad_id);
        $asignaturas_especialidad = [];
        $planes_especialidades = $especialidad->planes_especialidades;
        foreach ($planes_especialidades as $key_2 => $plan_especialidad) {
            $asignaturas_plan = $plan_especialidad->asignaturas;
            foreach ($asignaturas_plan as $key_3 => $asignatura_plan) {
                $match = false;
                foreach ($asignaturas_especialidad as $key_4 => $asignatura_especialidad) {
                    if($asignatura_especialidad->id == $asignatura_plan->id){
                        $match=true;
                    }
                }
                if(!$match){

                    array_push($asignaturas_especialidad,$asignatura_plan);
                }
            }
        }
        $docentes = Docente::get();
        $dias = Dia::get();
        return view('private.admin.academicos.clases.create',[
            'docentes'          => $docentes,
            'asignaturas'       => $asignaturas_especialidad,
            'dias'              => $dias,
            'periodo_id'        => $request->periodo_id,
            'especialidad_id'   => $request->especialidad_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClaseStoreRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show(Clase $clase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function edit(Clase $clase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clase $clase)
    {
        //
    }
}
