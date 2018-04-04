<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPlanReticula extends Model
{
    protected $table = 'tipos_planes_reticulas';
    
    protected $fillable = [
    	'tipo_plan_reticula','descripcion'
    ];

    public $timestamps = false;

    public function reticulas(){
    	return $this->hasMany('App\Models\Reticula','tipo_plan_reticula_id');
    }

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','tipo_plan_reticula_id');
    }

    public function asignaturas(){
        return $this->belongsToMany('App\Models\Asignatura','reticulas','tipo_plan_reticula_id','asignatura_id')
            ->withPivot('periodo_especialidad','especialidad_id');
    }

    public function especialidades(){
        return $this->belongsToMany('App\Models\Especialidad','reticulas','tipo_plan_reticula_id','especialidad_id')
            ->withPivot('periodo_especialidad','asignatura_id');
    }
}
