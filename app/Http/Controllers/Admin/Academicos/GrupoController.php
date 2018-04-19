<?php

namespace App\Http\Controllers\Admin\Academicos;

use App\Models\Grupo;
use App\Models\Clase;
use App\Models\Kardex;
use App\Models\Dia;
use App\Models\Estudiante;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Grupo\IndexRequest;
use App\Http\Requests\Admin\Grupo\StoreRequest;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $clase = Clase::find($request->clase);
        $dias = Dia::get();

        return view('private.admin.academicos.grupos.index',[
            'clase' => $clase,
            'dias'  => $dias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $grupo = new Grupo;
        $grupo->clase_id        = $request->clase_id;
        $grupo->estudiante_id   = $request->estudiante_id;
        $grupo->oportunidad_id  = $request->oportunidad_id;
        $grupo->save();

        $clase = Clase::find($request->clase_id);
        $estudiante = Estudiante::find($request->estudiante_id);

        $kardex = new Kardex;
        $kardex->estudiante_id      = $estudiante->id;
        $kardex->asignatura_id      = $clase->asignatura_id;
        $kardex->oportunidad_id     = $request->oportunidad_id;
        $kardex->periodo_id         = $clase->periodo_id;
        $kardex->semestre           = $estudiante->semestre;
        $kardex->save();

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        $clase = Clase::find($grupo->clase_id);

        $kardex = Kardex::where([
            ['estudiante_id',$grupo->estudiante_id],
            ['asignatura_id',$clase->asignatura_id],
            ['oportunidad_id',$grupo->oportunidad_id],
            ['periodo_id',$clase->periodo_id]
        ])->first();

        $kardex->delete();
        $grupo->delete();
        return;
    }
}
