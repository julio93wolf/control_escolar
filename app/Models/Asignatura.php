<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignaturas';

    protected $fillable = [
    	'codigo','asignatura','semestre','creditos','reticula_id'
    ];

    public $timestamps = false;

    public function especialidades(){
        return $this->belongsToMany('App\Models\Especialidad','reticulas','asignatura_id','especialidad_id')
            ->withPivot('periodo_especialidad','tipo_plan_reticula_id');
    }

    public function tipos_planes_reticulas(){
        return $this->belongsToMany('App\Models\TipoPlanReticula','reticulas','asignatura_id','tipo_plan_reticula_id')
            ->withPivot('periodo_especialidad','especialidad_id');
    }
}
