<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subcategory;
use Faker\Generator as Faker;

$factory->define(Subcategory::class, function (Faker $faker) {
    $name = $faker->words(3, true);
    $slug = Str::of($name)->slug('-');

    return [
        'name' => $name,
        'slug' => $slug,
        'subject_id' => $faker->numberBetween(1, 9),
    ];
});
