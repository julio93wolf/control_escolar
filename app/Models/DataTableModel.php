<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataTableModel extends Model
{
    static function estudiantes(){
    	return \DB::table('vw_estudiantes');
  	}
}
