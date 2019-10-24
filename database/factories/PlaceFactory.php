<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Place;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'company_id' => function () {
            return factory(\App\Models\Company::class)->create()->id;
        },
        'active' => 1
    ];
});
