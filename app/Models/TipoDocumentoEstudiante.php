<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoEstudiante extends Model
{
    protected $table = 'tipos_documentos_estudiante';
    
    protected $fillable = [
    	'tipo_documento','descripcion'
    ];

    public $timestamps = false;

    public function documentos_estudiante(){
    	return $this->hasMany('App\Models\DocumentoEstudiante','tipo_documento_id');
    }
}
