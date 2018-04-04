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
      		factory(App\Models\Reticula::class,5)->create([
      			'especialidad_id' => $especialidad->id
      		]);
      	}
    }
}
