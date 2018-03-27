<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = 'clases';
    
    protected $fillable = [
    	'asignatura_id','clase','docente_id','periodo_id'
    ];

    public $timestamps = false;

    public function horarios(){
    	return $this->hasMany('App\Models\Horario','clase_id');
    }

    public function grupos(){
    	return $this->hasMany('App\Models\Grupo','clase_id');
    }

    public function asignatura(){
    	return $this->belongsTo('App\Models\Asignatura','asignatura_id');
    }

    public function docente(){
    	return $this->belongsTo('App\Models\Docente','docente_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }
}
