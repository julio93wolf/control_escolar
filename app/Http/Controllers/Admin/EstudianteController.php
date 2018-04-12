<?php

namespace App\Http\Controllers\Admin;

use App\Models\Estudiante;
use App\Models\EstadoCivil;
use App\Models\Nacionalidad;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Localidad;
use App\Models\NivelAcademico;
use App\Models\ModalidadEstudiante;
use App\Models\EstadoEstudiante;
use App\Models\MedioEnterado;
use App\Models\InstitutoProcedencia;
use App\Models\Empresa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.academicos.estudiantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.admin.academicos.estudiantes.create',[
            'estados_civiles'           => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'nacionalidades'            => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'estados'                   => Estado::orderBy('estado','ASC')->get(),
            'municipios'                => Municipio::where('estado_id',11)->orderBy('municipio','ASC')->get(),
            'localidades'               => Localidad::where('municipio_id',327)->orderBy('localidad','ASC')->get(),
            'niveles_academicos'        => NivelAcademico::orderBy('id','ASC')->get(),
            'modalidades_estudiantes'   => ModalidadEstudiante::orderBy('id','ASC')->get(),
            'estados_estudiantes'       => EstadoEstudiante::orderBy('id','ASC')->get(),
            'medios_enterados'          => MedioEnterado::orderBy('id','ASC')->get(),
            'institutos_procedencias'   => InstitutoProcedencia::orderBy('id','ASC')->get(),
            'empresas'                  => Empresa::orderBy('id','ASC')->get()
        ]);
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
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
