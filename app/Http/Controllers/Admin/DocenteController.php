<?php

namespace App\Http\Controllers\Admin;

use App\Models\Docente;
use App\Models\EstadoCivil;
use App\Models\Nacionalidad;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Localidad;
use App\Models\Titulo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.academicos.docentes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.admin.academicos.docentes.create',[
            'estados_civiles'   => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'nacionalidades'    => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'estados'           => Estado::orderBy('estado','ASC')->get(),
            'municipios'        => Municipio::where('estado_id',11)->orderBy('municipio','ASC')->get(),
            'localidades'       => Localidad::where('municipio_id',327)->orderBy('localidad','ASC')->get(),
            'titulos'           => Titulo::orderBy('id','ASC')->get()
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
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        //
    }
}
