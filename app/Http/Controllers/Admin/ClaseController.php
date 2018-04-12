<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clase;
use App\Models\NivelAcademico;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\Especialidad;
use App\Models\Dia;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClaseCreateRequest;
use App\Http\Requests\ClaseStoreRequest;
use App\Http\Requests\ClaseUpdateRequest;

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
        //dd($request);
        $clase = new Clase;
        $clase->asignatura_id   = $request->asignatura_id;
        $clase->clase           = $request->clase;
        $clase->docente_id      = $request->docente_id;
        $clase->especialidad_id = $request->especialidad_id;
        $clase->periodo_id      = $request->periodo_id;
        $clase->save();

        foreach ($request->dia as $key => $dia) {
            $horario = new Horario;
            $horario->dia_id        = $dia+1;
            $horario->clase_id      = $clase->id;
            $horario->hora_entrada  = $request->hora_inicio[$dia];
            $horario->hora_salida   = $request->hora_salida[$dia];
            $horario->save();
        } 

        return view('private.admin.academicos.clases.index',[
            'niveles_academicos' => NivelAcademico::get(),
            'periodos'           => Periodo::get()
        ]);
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
        $especialidad = Especialidad::find($clase->especialidad_id);
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
        return view('private.admin.academicos.clases.edit',[
            'clase'             => $clase,
            'horarios'          => $clase->horarios,
            'docentes'          => $docentes,
            'asignaturas'       => $asignaturas_especialidad,
            'dias'              => $dias
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(ClaseUpdateRequest $request, Clase $clase)
    {
        //dd($request);
        $clase->asignatura_id   = $request->asignatura_id;
        $clase->clase           = $request->clase;
        $clase->docente_id      = $request->docente_id;
        $clase->save();

        $horarios = $clase->horarios;
        foreach ($horarios as $key => $horario) {
            $horario->delete();
        }

        foreach ($request->dia as $key => $dia) {
            $new_horario = new Horario;
            $new_horario->dia_id        = $dia+1;
            $new_horario->clase_id      = $clase->id;
            $new_horario->hora_entrada  = $request->hora_inicio[$dia];
            $new_horario->hora_salida   = $request->hora_salida[$dia];
            $new_horario->save();
        } 

        return view('private.admin.academicos.clases.index',[
            'niveles_academicos' => NivelAcademico::get(),
            'periodos'           => Periodo::get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clase $clase)
    {
        $clase->delete();
    }
}
