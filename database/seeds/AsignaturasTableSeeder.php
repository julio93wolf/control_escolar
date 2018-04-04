<?php

use Illuminate\Database\Seeder;
use App\Models\Reticula;

class AsignaturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reticulas = Reticula::get();
        foreach ($reticulas as $key => $reticula) {
        	factory(App\Models\Asignatura::class,20)->create([
      			'reticula_id' => $reticula->id
      		]);
        }
    }
}
