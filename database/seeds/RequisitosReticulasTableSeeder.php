<?php

use Illuminate\Database\Seeder;
use App\Models\Especialidad;
use App\Models\Reticula;
use App\Models\RequisitoReticula;

class RequisitosReticulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asignaturas_anteriores = [];
        
        $especialidades = Especialidad::get();
        foreach ($especialidades as $key => $especialidad) {
        	$asignaturas = $especialidad->asignaturas;
        	
        	foreach ($asignaturas as $key => $asignatura) {

        		$pivot = $asignatura->pivot;

        		$reticula = Reticula::where([
            	['especialidad_id',$pivot->especialidad_id],
            	['asignatura_id',$pivot->asignatura_id],
            	['periodo_especialidad',$pivot->periodo_especialidad],
            	['tipo_plan_reticula_id',1],
        		])->first();
        		
        		//Periodo
      		 	$periodo_especialidad = $asignatura->pivot->periodo_especialidad;
      		 	
      		 	//Asignaturas Anteriores
      		 	foreach ($asignaturas as $key_ant => $asignatura_ant) {
      		 		if($asignatura_ant->id != $asignatura->id ){
      		 			if($asignatura_ant->pivot->periodo_especialidad <= $periodo_especialidad){
      		 				array_push($asignaturas_anteriores,$asignatura_ant);
      		 			}
      		 		}
      			}

      			if(count($asignaturas_anteriores)>0){
      				
      				$ini = count($asignaturas_anteriores)-3;
      				$fin = count($asignaturas_anteriores);

							if($ini<0){
								$ini=0;
							}
							
      				for ($i=$ini; $i < $fin; $i++) { 
      					
      					$asignatura_anterior = $asignaturas_anteriores[$i];

      					$pivot_ant = $asignatura_anterior->pivot;

      					$reticula_requisito = Reticula::where([
		            	['especialidad_id',$pivot_ant->especialidad_id],
		            	['asignatura_id',$pivot_ant->asignatura_id],
		            	['periodo_especialidad',$pivot_ant->periodo_especialidad],
		            	['tipo_plan_reticula_id',1],
		        		])->first();

      					RequisitoReticula::create([
				        	'reticula_id'						=> $reticula->id,
				        	'reticula_requisito_id'	=> $reticula_requisito->id
				        ]);
      				}
      			}
      			
      					

        	}
        }
    }
}
