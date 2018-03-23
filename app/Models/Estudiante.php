<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    
    protected $fillable = [
    	'datos_generales_id','especialidad_id','estado_id','matricula','semestre','grupo',',modalidad_id','enterado_por_id','periodo_id','otros','usuario_id'
    ];

    public $timestamps = false;

    public function equivalencias(){
    	return $this->hasMany('App\Models\Equivalencia','estudiante_id');
    }

    public function documentos_estudiante(){
    	return $this->hasMany('App\Models\DocumentoEstudiante','estudiante_id');
    }

    public function titulaciones(){
    	return $this->hasMany('App\Models\Titulacion','estudiante_id');
    }

    public function grupos(){
    	return $this->hasMany('App\Models\Grupo','estudiante_id');
    }

    public function empresas(){
    	return $this->belongsToMany('App\Models\Empresa','estudiante_trabajo','estudiante_id','empresa_id')
    		->withPivot('puesto');
    }

    public function institutos_procedencia(){
    	return $this->belongsToMany('App\Models\InstitutoProcedencia','procedencia_estudiante','estudiante_id','instituto_id');
    }

    public function datos_generales(){
    	return $this->belongsTo('App\Models\DatosGenerales','datos_generales_id');
    }

		public function especialidad(){
    	return $this->belongsTo('App\Models\Especialidad','especialidad_id')
    }

    public function estado_estudiante(){
    	return $this->belongsTo('App\Models\EstadoEstudiante','estado_id');
    }

    public function modalidad(){
    	return $this->belongsTo('App\Models\Modalidad','modalidad_id');
    }

    public function medio_enterado(){
    	return $this->belongsTo('App\Models\MedioEnterado','enterado_por_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuario','usuario_id');
    }

}