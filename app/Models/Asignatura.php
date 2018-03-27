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

    public function clases(){
    	return $this->hasMany('App\Models\Clase','asignatura_id');
    }

    public function reticula(){
    	return $this->belongsTo('App\Models\Reticula','reticula_id');
    }

    //Revisar
    public function requisitos(){
    	return $this->belongsToMany('App\Models\Asignatura','requisitos_asignaturas','asignatura_id','asignatura_requisito');
    }

    public function requisito(){
        return $this->belongsToMany('App\Models\Asignatura','requisitos_asignaturas','asignatura_requisito','asignatura_id');
    }
}
