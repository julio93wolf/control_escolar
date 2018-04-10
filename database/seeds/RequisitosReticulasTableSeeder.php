<?php

use Illuminate\Database\Seeder;
use App\Models\PlanEspecialidad;
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
      $planes_especialidades = PlanEspecialidad::get();
      foreach ($planes_especialidades as $key => $plan_especialidad) {
      	$asignaturas = $plan_especialidad->asignaturas;
      	
      	foreach ($asignaturas as $key => $asignatura) {

      		$pivot = $asignatura->pivot;

      		$reticula = Reticula::where([
          	['plan_especialidad_id',$pivot->plan_especialidad_id],
          	['asignatura_id',$pivot->asignatura_id],
          	['periodo_reticula',$pivot->periodo_reticula]
      		])->first();
      
      		//Periodo
    		 	$periodo_reticula = $pivot->periodo_reticula;
    		 	
    		 	//Asignaturas Anteriores
    		 	foreach ($asignaturas as $key_ant => $asignatura_ant) {
    		 		if($asignatura_ant->id != $asignatura->id ){
    		 			if($asignatura_ant->pivot->periodo_reticula < $periodo_reticula){
    		 				array_push($asignaturas_anteriores,$asignatura_ant);
    		 			}
    		 		}
    			}

          //Si en encuentra materias anteriores
    			if(sizeof($asignaturas_anteriores)>0){
    				
    				$ini = sizeof($asignaturas_anteriores)-3;
    				$fin = sizeof($asignaturas_anteriores);

						if($ini<0){
							$ini=0;
						}
						
    				for ($i=$ini; $i < $fin; $i++) { 
    					
    					$asignatura_anterior = $asignaturas_anteriores[$i];

    					$pivot_ant = $asignatura_anterior->pivot;

    					$reticula_requisito = Reticula::where([
	            	['plan_especialidad_id',$pivot_ant->plan_especialidad_id],
	            	['asignatura_id',$pivot_ant->asignatura_id],
	            	['periodo_reticula',$pivot_ant->periodo_reticula]
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
