<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'preparation' => $faker->word,
        'time' => $faker->word,
        'place_id' => function () {
            return factory(\App\Models\Place::class)->create()->id;
        },
        'is_enabled' => 1
    ];
});
