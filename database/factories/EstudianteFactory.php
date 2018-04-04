<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Estudiante::class, function (Faker $faker) {
    return [
        'dato_general_id' => 1,
        'especialidad_id' => rand(1,18),
        'estado_id' => rand(1,4),
        'matricula' => $faker->unique()->isbn13,
        'semestre' => rand (1,8),
        'grupo' => $faker->randomElement(['A','B','C']),
        'modalidad_id' => rand(1,3),
        'medio_enterado_id' => rand(1,5),
        'periodo_id' => rand(1,15),
        'otros' => $faker->text(100),
        'usuario_id' => 1,
        "tipo_plan_reticula_id" => 1
    ];
});
