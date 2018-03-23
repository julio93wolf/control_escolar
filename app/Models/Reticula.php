<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reticula extends Model
{
    protected $table = 'reticulas';
    
    protected $fillable = [
    	'especialida_id','reticula','periodo_especialidad'
    ];

    public $timestamps = false;

    public function asignaturas(){
    	return $this->hasMany('App\Models\Asignatura','reticula_id');
    }

    public function especialidad(){
    	return $this->belongsTo('App\Models\Especialidad','especialida_id');
    }
}
