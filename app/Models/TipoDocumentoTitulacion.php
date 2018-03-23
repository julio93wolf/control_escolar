<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoTitulacion extends Model
{
    protected $table = 'tipos_documentos_titulacion';
    
    protected $fillable = [
    	'tipo_documento','descripcion'
    ];

    public $timestamps = false;

    public function documentos_titulacion(){
    	return $this->hasMany('App\Models\DocumentoTitulacion','tipo_documento_id');
    }
}
