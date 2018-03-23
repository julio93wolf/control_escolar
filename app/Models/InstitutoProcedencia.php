<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutoProcedencia extends Model
{
    protected $table = 'institutos_procedencia';
    
    protected $fillable = [
    	'institucion','municipio_id'
    ];

    public $timestamps = false;

    public function municipio(){
    	return $this->belongsTo('App\Models\Municipio','municipio_id');
    }

    public function estudiantes(){
    	return $this->belongsToMany('App\Models\Estudiante','procedencia_estudiante','instituto_id','estudiante_id');
    }
}
