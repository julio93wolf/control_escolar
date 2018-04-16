<?php

namespace App\Http\Controllers\Admin;

use App\Models\InstitutoProcedencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutoProcedenciaStoreRequest;

class InstitutoProcedenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(InstitutoProcedenciaStoreRequest $request)
    {
        $instituto_procedencia = new InstitutoProcedencia;
        $instituto_procedencia->institucion     = $request->instituto;
        $instituto_procedencia->municipio_id    = $request->instituto_municipio_id;
        $instituto_procedencia->save();

        return InstitutoProcedencia::orderBy('id','ASC')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstitutoProcedencia  $institutoProcedencia
     * @return \Illuminate\Http\Response
     */
    public function show(InstitutoProcedencia $institutoProcedencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstitutoProcedencia  $institutoProcedencia
     * @return \Illuminate\Http\Response
     */
    public function edit(InstitutoProcedencia $institutoProcedencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstitutoProcedencia  $institutoProcedencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstitutoProcedencia $institutoProcedencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstitutoProcedencia  $institutoProcedencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstitutoProcedencia $institutoProcedencia)
    {
        //
    }
}
