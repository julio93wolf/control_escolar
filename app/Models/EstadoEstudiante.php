<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoEstudiante extends Model
{
    protected $table = 'estados_estudiante';
    
    protected $fillable = ['estado_estudiante','descripcion'];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','estado_id');
    }
}