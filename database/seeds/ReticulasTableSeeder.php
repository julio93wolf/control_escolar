<?php

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class ReticulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      	$especialidades = Especialidad::get();
      	foreach ($especialidades as $key => $especialidad) {
          for ($i=0; $i < 25; $i++) { 
            factory(App\Models\Reticula::class,1)->create([
              'especialidad_id'      => $especialidad->id,
              'periodo_especialidad' => rand(1,$especialidad->periodos)
            ]);
          }
      	}
    }
}
