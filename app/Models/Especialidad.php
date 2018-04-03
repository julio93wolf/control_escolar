<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    
    protected $fillable = [
    	'nivel_academico_id','clave','especialidad','periodos','reconocimiento_oficial','dges','fecha_reconocimiento','descripcion','modalidad_id'
    ];

    public $timestamps = false;

    public function reticulas(){
    	return $this->hasMany('App\Models\Reticula','especialidad_id');
    }

    public function nivel_academico(){
    	return $this->belongsTo('App\Models\NivelAcademico','nivel_academico_id');
    }

    public function modalidad(){
        return $this->belongsTo('App\Models\ModalidadEspecialidad','modalidad_id');
    }

    public function tipo_plan(){
        return $this->belongsTo('App\Models\TipoPlan','tipo_plan_id');
    }
}
