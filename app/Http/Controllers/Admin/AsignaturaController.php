<?php

namespace App\Http\Controllers\Admin;

use App\Models\Asignatura;
use App\Models\NivelAcademico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\AsignaturaStoreRequest;
use App\Http\Requests\AsignaturaUpdateRequest;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.escolares.asignaturas.index',[
            'niveles_academicos'   => NivelAcademico::orderBy('id','ASC')->get()
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
    public function store(AsignaturaStoreRequest $request)
    {
        $asignatura = new Asignatura;
        $asignatura->asignatura = $request->asignatura;
        $asignatura->codigo = $request->codigo;
        $asignatura->creditos = $request->creditos;
        $asignatura->save();
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignatura $asignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function update(AsignaturaUpdateRequest $request, Asignatura $asignatura)
    {
        $asignatura = Asignatura::find($asignatura->id);
        $asignatura->asignatura = $request->asignatura;
        $asignatura->codigo = $request->codigo;
        $asignatura->creditos = $request->creditos;
        $asignatura->save();
        return ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignatura $asignatura)
    {
        //
    }
}
