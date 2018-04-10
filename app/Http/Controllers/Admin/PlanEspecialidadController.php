<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlanEspecialidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanEspecialidadController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(PlanEspecialidad $planes_especialidade)
    {
        return $planes_especialidade;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanEspecialidad $planes_especialidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanEspecialidad $planes_especialidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanEspecialidad $planes_especialidade)
    {
        //
    }
}
