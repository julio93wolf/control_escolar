<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reticula extends Model
{
    protected $table = 'reticulas';
    
    protected $fillable = [
    	'especialida_id','reticula','periodo_especialidad','tipo_plan_reticula_id'
    ];

    public $timestamps = false;

    public function clases(){
        return $this->hasMany('App\Models\Clase','reticula_id');
    }

    public function asignatura(){
    	return $this->belongsTo('App\Models\Asignatura','asignatura_id');
    }

    public function especialidad(){
    	return $this->belongsTo('App\Models\Especialidad','especialidad_id');
    }

    public function tipo_plan_reticula(){
        return $this->belongsTo('App\Models\TipoPlanReticula','tipo_plan_reticula_id');
    }

    public function requisitos(){
        return $this->belongsToMany('App\Models\Reticula','requisitos_reticulas','reticula_id','reticula_requisito_id');
    }
}
