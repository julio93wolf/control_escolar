<?php

use Illuminate\Database\Seeder;

class TiposPlanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tipos_planes")->insert([ "id" => 1, "tipo_plan" => "Semestral" ]);
        DB::table("tipos_planes")->insert([ "id" => 2, "tipo_plan" => "Cuatrimestral" ]);
        DB::table("tipos_planes")->insert([ "id" => 3, "tipo_plan" => "Bimestral" ]);
    }
}
