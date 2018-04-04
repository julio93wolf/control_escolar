<?php

namespace App\Http\Controllers\Admin;

use App\Models\FechaExamen;
use App\Models\TipoExamen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FechaExamenStoreRequest;
use App\Http\Requests\FechaExamenUpdateRequest;

class FechaExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('private.admin.escolares.fechas_examenes.index',[
            'periodo'           => $request->periodo,
            'tipos_examenes'    => TipoExamen::orderBy('id','ASC')->get()
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
    public function store(FechaExamenStoreRequest $request)
    {
        $fecha_examen = new FechaExamen;

        $fecha_examen->tipo_examen_id   = $request->tipo_examen_id;
        $fecha_examen->fecha_inicio     = $request->fecha_inicio;
        $fecha_examen->fecha_final      = $request->fecha_final;
        $fecha_examen->periodo_id       = $request->periodo_id;
        $fecha_examen->descripcion      = $request->descripcion;

        $fecha_examen->save();
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FechaExamen  $fechaExamen
     * @return \Illuminate\Http\Response
     */
    public function show(FechaExamen $fechas_examene)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FechaExamen  $fechaExamen
     * @return \Illuminate\Http\Response
     */
    public function edit(FechaExamen $fechas_examene)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FechaExamen  $fechaExamen
     * @return \Illuminate\Http\Response
     */
    public function update(FechaExamenUpdateRequest $request, FechaExamen $fechas_examene)
    {
        $fecha_examen = FechaExamen::find($fechas_examene->id);

        $fecha_examen->tipo_examen_id   = $request->tipo_examen_id;
        $fecha_examen->fecha_inicio     = $request->fecha_inicio;
        $fecha_examen->fecha_final      = $request->fecha_final;
        $fecha_examen->descripcion      = $request->descripcion;

        $fecha_examen->save();
        return ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FechaExamen  $fechaExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(FechaExamen $fechas_examene)
    {
        FechaExamen::find($fechas_examene->id)->delete();
    }
}
