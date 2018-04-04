<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reticula::class, function (Faker $faker) {
    return [
        'especialidad_id' => 1,
        'asignatura_id' => rand(1,200),
        'tipo_plan_reticula_id' => 1,
        'periodo_especialidad' => 1,
    ];
});
