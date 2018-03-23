<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table = 'modalidades';
    
    protected $fillable = [
    	'modalidad','descripcion'
    ];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','modalidad_id');
    }
}