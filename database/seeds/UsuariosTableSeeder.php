<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
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
        /*
        $faker = Faker::class;
        factory(App\Models\Usuario::class,150)->create();
        $usuarios = App\Models\Usuario::get();
        foreach ($usuarios as $key => $usuario) {
            if($usuario->rol_id == 2){
                Estudiante::create([
                    'datos_generales_id' => $key,
                    'especialidad_id' => rand(1,18),
                    'estado_id' => rand(1,4),
                    'matricula' => $faker->creditCardNumber,
                    'semestre' => rand(1,6),
                    'grupo' => $faker->randomLetter,
                    'modalidad_id' => rand(1,3),
                    'enterado_por_id' => rand(1,5),
                    'periodo_id' => ()

                ]);
            }
            if($usuario->rol_id == 3){
                
            }
        }*/
        
        Usuario::create([
        	'email' => 'admin@appsamx.com',
        	'password' => bcrypt('Appsa2016'),
            'rol_id' => 1
        ]);
    }
}
