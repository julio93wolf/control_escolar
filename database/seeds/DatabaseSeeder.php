<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesUsuariosTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        //$this->call(LocalidadesTableSeeder::class); Hacerlo desde consola
        $this->call(TiposDocumentosEstudiantesTableSeeder::class);
        $this->call(EstadosEstudiantesTableSeeder::class);
        $this->call(EstadosCivilesTableSeeder::class);
        $this->call(InstitutosProcedenciasTableSeeder::class);
        $this->call(MediosEnteradosTableSeeder::class);
        $this->call(ModalidadesEspecialidadesTableSeeder::class);
        $this->call(ModalidadesEstudiantesTableSeeder::class);
        $this->call(NacionalidadesTableSeeder::class);
        $this->call(NivelesAcademicosTableSeeder::class);
        $this->call(TiposPlanesTableSeeder::class);
        $this->call(EspecialidadesTableSeeder::class);
        $this->call(EstadosTitulacionesTableSeeder::class);
    }
}
