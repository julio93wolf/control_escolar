<?php

namespace App\Http\Controllers\Admin;

use App\Models\Periodo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodoStoreRequest;
use App\Http\Requests\PeriodoUpdateRequest;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.escolares.periodos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.admin.escolares.periodos.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodoStoreRequest $request)
    {
        $periodo = new Periodo;

        $periodo->periodo                   = $request->periodo;
        $periodo->anio                      = $request->anio;
        $periodo->reconocimiento_oficial    = $request->reconocimiento_oficial;
        $periodo->dges                      = $request->dges;
        $periodo->fecha_reconocimiento      = $request->fecha_reconocimiento_submit;

        $periodo->save();
        return view('private.admin.escolares.periodos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(Periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        return view('private.admin.escolares.periodos.edit',compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(PeriodoUpdateRequest $request, Periodo $periodo)
    {
        $periodo = Periodo::find($periodo->id);

        $periodo->periodo                   = $request->periodo;
        $periodo->anio                      = $request->anio;
        $periodo->reconocimiento_oficial    = $request->reconocimiento_oficial;
        $periodo->dges                      = $request->dges;
        $periodo->fecha_reconocimiento      = $request->fecha_reconocimiento_submit;
        
        $periodo->save();
        return view('private.admin.escolares.periodos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        Periodo::find($periodo->id)->delete();
    }
}
