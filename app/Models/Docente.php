<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docente';
    
    protected $fillable = [
    	'codigo','datos_generales_id','rfc','titulo_id','usuario_id'
    ];

    public $timestamps = false;

    public function clases(){
    	return $this->hasMany('App\Models\Clase','docente_id');
    }

    public function datos_generales(){
    	return $this->belongsTo('App\Models\DatosGenerales','datos_generales_id');
    }

    public function titulo(){
    	return $this->belongsTo('App\Models\Titulo','titulo_id');
    }

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuario','usuario_id');
    }
}
