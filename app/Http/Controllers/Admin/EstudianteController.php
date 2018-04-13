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
use App\Models\Especialidad;
use App\Models\PlanEspecialidad;
use App\Models\TipoDocumentoEstudiante;
use App\Models\Periodo;
use App\Models\Usuario;
use App\Models\DatoGeneral;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EstudianteStoreRequest;
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
            'especialidades'            => Especialidad::where('nivel_academico_id',1)->orderBy('id','ASC')->get(),
            'planes_especialidades'     => PlanEspecialidad::where('especialidad_id',1)->orderBy('id','ASC')->get(),
            'modalidades_estudiantes'   => ModalidadEstudiante::orderBy('id','ASC')->get(),
            'estados_estudiantes'       => EstadoEstudiante::orderBy('id','ASC')->get(),
            'medios_enterados'          => MedioEnterado::orderBy('id','ASC')->get(),
            'institutos'                => InstitutoProcedencia::orderBy('id','ASC')->get(),
            'empresas'                  => Empresa::orderBy('id','ASC')->get(),
            'tipos_documentos'          => TipoDocumentoEstudiante::orderBy('id','asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteStoreRequest $request)
    {
    
        $periodo = Periodo::orderBy('id','desc')->first();

        $usuario = new Usuario;
        $usuario->email     = $request->matricula.'@uniceba.edu.mx';
        $usuario->password  = password_hash('secret',PASSWORD_BCRYPT);
        $usuario->rol_id    = 2;
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
            $path = Storage::disk('estudiantes')->put('foto',$request->foto);
            $dato_general->fill([ 'foto' => $path ])->save();
        }

        $estudiante = new Estudiante;
        $estudiante->dato_general_id        = $dato_general->id;
        $estudiante->especialidad_id        = $request->especialidad_id;
        $estudiante->estado_estudiante_id   = $request->estado_estudiante_id;
        $estudiante->matricula              = $request->matricula;
        $estudiante->semestre               = 1;
        $estudiante->grupo                  = $request->grupo;
        $estudiante->modalidad_id           = $request->modalidad_id;
        $estudiante->medio_enterado_id      = $request->medio_enterado_id;
        $estudiante->periodo_id             = $periodo->id;
        $estudiante->otros                  = $request->otros;
        $estudiante->usuario_id             = $usuario->id;
        $estudiante->plan_especialidad_id   = $request->plan_especialidad_id;
        $estudiante->save();

        $estudiante->empresa()->attach($request->empresa_id,[
            'puesto'    => $request->puesto
        ]);
        $estudiante->instituto_procedencia()->attach($request->instituto_id);

        if($request->tipo_documento){
            foreach ($request->tipo_documento as $key => $td) {
                if(isset($request->documento[$td])){
                    $path = Storage::disk('estudiantes')->put('documentos',$request->documento[$td]);
                    $estudiante->documento_estudiante()->attach($td,[
                        'documento' => $path
                    ]);
                }else{
                    $estudiante->documento_estudiante()->attach($td);
                }
            }
        }

        return view('private.admin.academicos.estudiantes.index');
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
        $dato_general           = $estudiante->dato_general;
        $localidad              = $dato_general->localidad;
        $municipio              = $localidad->municipio;
        $especialidad           = $estudiante->especialidad;
        $instituto_procedencia  = $estudiante->instituto_procedencia->first();
        $empresa                = $estudiante->empresa->first();
        $documentos_estudiantes = $estudiante->documento_estudiante;

        $estudiante->curp                   = $dato_general->curp;
        $estudiante->nombre                 = $dato_general->nombre;
        $estudiante->apaterno               = $dato_general->apaterno;
        $estudiante->amaterno               = $dato_general->amaterno;
        $estudiante->fecha_nacimiento       = $dato_general->fecha_nacimiento;
        $estudiante->calle_numero           = $dato_general->calle_numero;
        $estudiante->colonia                = $dato_general->colonia;
        $estudiante->localidad_id           = $dato_general->localidad_id;
        $estudiante->telefono_personal      = $dato_general->telefono_personal;
        $estudiante->telefono_casa          = $dato_general->telefono_casa;
        $estudiante->estado_civil_id        = $dato_general->estado_civil_id;
        $estudiante->sexo                   = $dato_general->sexo;
        $estudiante->nacionalidad_id        = $dato_general->nacionalidad_id;
        $estudiante->email                  = $dato_general->email;
        $estudiante->codigo_postal          = $dato_general->codigo_postal;
        $estudiante->foto                   = $dato_general->foto;
        $estudiante->municipio_id           = $localidad->municipio_id;
        $estudiante->estado_id              = $municipio->estado_id;
        $estudiante->nivel_academico_id     = $especialidad->nivel_academico_id;
        $estudiante->especialidad_id        = $especialidad->id;
        $estudiante->empresa_id             = $empresa->id;
        $estudiante->instituto_id           = $instituto_procedencia->id;

        return view('private.admin.academicos.estudiantes.create',[
            'estudiante'                => $estudiante,
            'documentos_estudiantes'    => $documentos_estudiantes,
            'estados_civiles'           => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'nacionalidades'            => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'estados'                   => Estado::orderBy('estado','ASC')->get(),
            'municipios'        => Municipio::where('estado_id',$municipio->estado_id)->orderBy('municipio','ASC')->get(),
            'localidades'       => Localidad::where('municipio_id',$localidad->municipio_id)->orderBy('localidad','ASC')->get(),
            'niveles_academicos'        => NivelAcademico::orderBy('id','ASC')->get(),
            'especialidades'            => Especialidad::where('nivel_academico_id',$especialidad->nivel_academico_id)->orderBy('id','ASC')->get(),
            'planes_especialidades'     => PlanEspecialidad::where('especialidad_id',$especialidad->id)->orderBy('id','ASC')->get(),
            'modalidades_estudiantes'   => ModalidadEstudiante::orderBy('id','ASC')->get(),
            'estados_estudiantes'       => EstadoEstudiante::orderBy('id','ASC')->get(),
            'medios_enterados'          => MedioEnterado::orderBy('id','ASC')->get(),
            'institutos'                => InstitutoProcedencia::orderBy('id','ASC')->get(),
            'empresas'                  => Empresa::orderBy('id','ASC')->get(),
            'tipos_documentos'          => TipoDocumentoEstudiante::orderBy('id','asc')->get()
        ]);
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
