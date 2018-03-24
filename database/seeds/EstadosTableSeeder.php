<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table("estados")->insert([ "id" => 1, "pais_id" => 35, "clave" => "01", "estado" => "Aguascalientes", "abreviatura" => "Ags.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 2, "pais_id" => 35, "clave" => "02", "estado" => "Baja California", "abreviatura" => "BC", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 3, "pais_id" => 35, "clave" => "03", "estado" => "Baja California Sur", "abreviatura" => "BCS", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 4, "pais_id" => 35, "clave" => "04", "estado" => "Campeche", "abreviatura" => "Camp.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 5, "pais_id" => 35, "clave" => "05", "estado" => "Coahuila de Zaragoza", "abreviatura" => "Coah.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 6, "pais_id" => 35, "clave" => "06", "estado" => "Colima", "abreviatura" => "Col.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 7, "pais_id" => 35, "clave" => "07", "estado" => "Chiapas", "abreviatura" => "Chis.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 8, "pais_id" => 35, "clave" => "08", "estado" => "Chihuahua", "abreviatura" => "Chih.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 9, "pais_id" => 35, "clave" => "09", "estado" => "Distrito Federal", "abreviatura" => "DF", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 10, "pais_id" => 35, "clave" => "10", "estado" => "Durango", "abreviatura" => "Dgo.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 11, "pais_id" => 35, "clave" => "11", "estado" => "Guanajuato", "abreviatura" => "Gto.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 12, "pais_id" => 35, "clave" => "12", "estado" => "Guerrero", "abreviatura" => "Gro.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 13, "pais_id" => 35, "clave" => "13", "estado" => "Hidalgo", "abreviatura" => "Hgo.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 14, "pais_id" => 35, "clave" => "14", "estado" => "Jalisco", "abreviatura" => "Jal.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 15, "pais_id" => 35, "clave" => "15", "estado" => "México", "abreviatura" => "Mex.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 16, "pais_id" => 35, "clave" => "16", "estado" => "Michoacán de Ocampo", "abreviatura" => "Mich.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 17, "pais_id" => 35, "clave" => "17", "estado" => "Morelos", "abreviatura" => "Mor.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 18, "pais_id" => 35, "clave" => "18", "estado" => "Nayarit", "abreviatura" => "Nay.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 19, "pais_id" => 35, "clave" => "19", "estado" => "Nuevo León", "abreviatura" => "NL", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 20, "pais_id" => 35, "clave" => "20", "estado" => "Oaxaca", "abreviatura" => "Oax.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 21, "pais_id" => 35, "clave" => "21", "estado" => "Puebla", "abreviatura" => "Pue.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 22, "pais_id" => 35, "clave" => "22", "estado" => "Querétaro", "abreviatura" => "Qro.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 23, "pais_id" => 35, "clave" => "23", "estado" => "Quintana Roo", "abreviatura" => "Q. Roo", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 24, "pais_id" => 35, "clave" => "24", "estado" => "San Luis Potosí", "abreviatura" => "SLP", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 25, "pais_id" => 35, "clave" => "25", "estado" => "Sinaloa", "abreviatura" => "Sin.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 26, "pais_id" => 35, "clave" => "26", "estado" => "Sonora", "abreviatura" => "Son.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 27, "pais_id" => 35, "clave" => "27", "estado" => "Tabasco", "abreviatura" => "Tab.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 28, "pais_id" => 35, "clave" => "28", "estado" => "Tamaulipas", "abreviatura" => "Tamps.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 29, "pais_id" => 35, "clave" => "29", "estado" => "Tlaxcala", "abreviatura" => "Tlax.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 30, "pais_id" => 35, "clave" => "30", "estado" => "Veracruz de Ignacio de la Llave", "abreviatura" => "Ver.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 31, "pais_id" => 35, "clave" => "31", "estado" => "Yucatán", "abreviatura" => "Yuc.", "activo" => 1]);
			DB::table("estados")->insert([ "id" => 32, "pais_id" => 35, "clave" => "32", "estado" => "Zacatecas", "abreviatura" => "Zac.", "activo" => 1]);
    }
}
