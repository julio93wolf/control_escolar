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
        
        factory(App\Models\Usuario::class,1500)->create()->each(function(App\Models\Usuario $usuario){
            if($usuario->rol_id == 2){
                factory(App\Models\Estudiante::class,1)->create([
                    'datos_generales_id' => $usuario->id,
                    'usuario_id' => $usuario->id
                ]);
            }
            if($usuario->rol_id == 3){
                factory(App\Models\Estudiante::class,1)->create([
                    'datos_generales_id' => $usuario->id,
                    'usuario_id' => $usuario->id
                ]);
            }
        });

        Usuario::create([
        	'email' => 'admin@appsamx.com',
        	'password' => bcrypt('Appsa2016'),
            'rol_id' => 1
        ]);
    }
}
