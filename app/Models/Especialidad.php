<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    
    protected $fillable = [
    	'nivel_academico_id','clave','especialidad','periodos','reconocimiento_oficial','dges','fecha_reconocimiento','descripcion','modalidad_id','tipo_plan_especialidad_id'
    ];

    public $timestamps = false;

    public function asignaturas(){
        return $this->belongsToMany('App\Models\Asignatura','reticulas','especialidad_id','asignatura_id')
            ->withPivot('periodo_especialidad','tipo_plan_reticula_id');
    }

    public function tipos_planes_reticulas(){
        return $this->belongsToMany('App\Models\TipoPlanReticula','reticulas','especialidad_id','tipo_plan_reticula_id')
            ->withPivot('periodo_especialidad','asignatura_id');
    }

    public function nivel_academico(){
    	return $this->belongsTo('App\Models\NivelAcademico','nivel_academico_id');
    }

    public function modalidad(){
        return $this->belongsTo('App\Models\ModalidadEspecialidad','modalidad_id');
    }

    public function tipo_plan_especialidad(){
        return $this->belongsTo('App\Models\TipoPlanEspecialidad','tipo_plan_especialidad_id');
    }
}
