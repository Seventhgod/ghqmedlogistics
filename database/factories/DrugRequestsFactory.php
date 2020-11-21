<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DrugRequests;
use Faker\Generator as Faker;

$factory->define(DrugRequests::class, function (Faker $faker) {

    return [
        'project_name' => $faker->word,
        'project_date' => $faker->word,
        'initiator' => $faker->word,
        'unit' => $faker->word,
        'pharmacist' => $faker->word,
        'file_number' => $faker->word,
        'indent_number' => $faker->word,
        'mission_code' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
