<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    
    protected $fillable = [
    	'email','password'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','usuario_id');
    }

    public function docentes(){
    	return $this->hasMany('App\Models\Docente','usuario_id');
    }
}