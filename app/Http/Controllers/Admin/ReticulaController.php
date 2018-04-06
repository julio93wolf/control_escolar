<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reticula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReticulaStoreRequest;

class ReticulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $reticula = Reticula::where([
            ['especialidad_id',$request->especialidad_id],
            ['asignatura_id',$request->asignatura_id],
            ['periodo_especialidad',$request->periodo_especialidad],
            ['tipo_plan_reticula_id',1],
        ])->first();
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
    public function store(ReticulaStoreRequest $request)
    {
        $reticula = new Reticula;

        $reticula->especialidad_id          = $request->especialidad_id;
        $reticula->asignatura_id            = $request->asignatura_id;
        $reticula->periodo_especialidad     = $request->periodo_especialidad;
        $reticula->tipo_plan_reticula_id    = 1;

        $reticula->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function show(Reticula $reticula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function edit(Reticula $reticula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reticula $reticula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Reticula $reticula)
    {
        $reticula = Reticula::where([
            ['especialidad_id',$request->especialidad_id],
            ['asignatura_id',$request->asignatura_id],
            ['periodo_especialidad',$request->periodo_especialidad],
            ['tipo_plan_reticula_id',1],
        ])->first();
        Reticula::find($reticula->id)->delete();
        return ;
    }
}
