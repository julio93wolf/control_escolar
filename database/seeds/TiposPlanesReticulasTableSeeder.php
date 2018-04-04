<?php

use Illuminate\Database\Seeder;

class TiposPlanesReticulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table("tipos_planes_reticulas")->insert([ "id" => 1, "tipo_plan_reticula" => "Default" ]);
    }
}
