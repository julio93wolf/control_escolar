<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    
    protected $fillable = [
    	'dato_general_id','especialidad_id','estado_estudiante_id','matricula','semestre','grupo',',modalidad_id','medio_enterado_id','periodo_id','otros','usuario_id','plan_especialidad_id'
    ];

    public $timestamps = false;


    public function empresa(){
        return $this->belongsToMany('App\Models\Empresa','estudiantes_trabajos','estudiante_id','empresa_id')
            ->withPivot('puesto');
    }

    public function documento_estudiante(){
    	return $this->belongsToMany('App\Models\TipoDocumentoEstudiante','documentos_estudiantes','estudiante_id','tipo_documento_id')
            ->withPivot('documento');
    }

    public function instituto_procedencia(){
        return $this->belongsToMany('App\Models\InstitutoProcedencia','procedencias_estudiantes','estudiante_id','instituto_id');
    }


    public function equivalencias(){
        return $this->hasMany('App\Models\Equivalencia','estudiante_id');
    }

    public function titulaciones(){
    	return $this->hasMany('App\Models\Titulacion','estudiante_id');
    }

    public function grupos(){
    	return $this->hasMany('App\Models\Grupo','estudiante_id');
    }

    public function dato_general(){
    	return $this->belongsTo('App\Models\DatoGeneral','dato_general_id');
    }

	public function especialidad(){
    	return $this->belongsTo('App\Models\Especialidad','especialidad_id');
    }

    public function estado_estudiante(){
    	return $this->belongsTo('App\Models\EstadoEstudiante','estado_estudiante_id');
    }

    public function modalidad(){
    	return $this->belongsTo('App\Models\ModalidadEstudiante','modalidad_id');
    }

    public function medio_enterado(){
    	return $this->belongsTo('App\Models\MedioEnterado','medio_enterado_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuario','usuario_id');
    }

    public function plan_especialidad(){
        return $this->belongsTo('App\Models\PlanEspecialidad','plan_especialidad_id');
    }    

}
