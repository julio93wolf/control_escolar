<?php

namespace App\Http\Controllers\Admin;

use App\Models\Docente;
use App\Models\EstadoCivil;
use App\Models\Nacionalidad;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Localidad;
use App\Models\Titulo;
use App\Models\Usuario;
use App\Models\DatoGeneral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DocenteStoreRequest;

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
    public function store(DocenteStoreRequest $request)
    {
        $usuario = new Usuario;
        $usuario->email     = $request->codigo.'@uniceba.edu.mx';
        $usuario->password  = password_hash('secret',PASSWORD_BCRYPT);
        $usuario->rol_id    = 3;
        $usuario->save();

        $dato_general = new DatoGeneral;
        $dato_general->curp                 = $request->curp;
        $dato_general->nombre               = $request->nombre;
        $dato_general->apaterno             = $request->apaterno;
        $dato_general->amaterno             = $request->amaterno;
        $dato_general->fecha_nacimiento     = $request->fecha_nacimiento_submit;
        $dato_general->calle_numero         = $request->calle_numero;
        $dato_general->colonia              = $request->colonia;
        $dato_general->localidad_id         = $request->localidad_id;
        $dato_general->telefono_personal    = $request->telefono_personal;
        $dato_general->telefono_casa        = $request->telefono_casa;
        $dato_general->estado_civil_id      = $request->estado_civil_id;
        $dato_general->sexo                 = $request->sexo;
        $dato_general->fecha_registro       = date("Y-m-d");
        $dato_general->nacionalidad_id      = $request->nacionalidad_id;
        $dato_general->email                = $request->email;
        $dato_general->codigo_postal        = $request->codigo_postal;
        $dato_general->save();

        //Image
        if($request->foto){
            $path = Storage::disk('docentes')->put('foto',$request->foto);
            $dato_general->fill(['foto' => asset($path)])->save();
        }

        $docente = new Docente;
        $docente->codigo            = $request->codigo;
        $docente->dato_general_id   = $dato_general->id;
        $docente->rfc               = $request->rfc;
        $docente->titulo_id         = $request->titulo_id;
        $docente->usuario_id        = $usuario->id;
        $docente->save();
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
