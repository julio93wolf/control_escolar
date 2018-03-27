<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    
    protected $fillable = [
    	'clase_id','estudiante_id','oportunidad_id','calificacion'
    ];

    public $timestamps = false;

    public function clase(){
    	return $this->belongsTo('App\Models\Clase','clase_id');
    }

    public function estudiante(){
    	return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }

    public function oportunidad(){
    	return $this->belongsTo('App\Models\Oportunidad','oportunidad_id');
    }
}
