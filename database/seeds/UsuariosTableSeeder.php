<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Estudiante;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
        	'email' => 'admin@appsamx.com',
        	'password' => bcrypt('Appsa2016'),
            'rol_id' => 1
        ]);

        factory(App\Models\Usuario::class,15000)->create()->each(function($usuario){
            $usuario->estudiantes()->save(factory(App\Models\Estudiante::class)->make());
        });
    }
}
