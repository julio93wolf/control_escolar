<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reticula::class, function (Faker $faker) {
    return [
        'especialidad_id' => 1,
        'reticula' => $faker->unique()->word,
        'periodo_especialidad' => rand(1,3),
        'tipo_plan_id' => rand(1,3)
    ];
});
