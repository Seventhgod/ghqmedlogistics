<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DrugRequest;
use Faker\Generator as Faker;

$factory->define(DrugRequest::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
