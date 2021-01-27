<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Topic::class, function (Faker $faker) {
    $name = $faker->words(3, true);
    $slug = Str::of($name)->slug('-');

    return [
        'name' => $name,
        'slug' => $slug,
        'subcategory_id' => $faker->numberBetween(1, 50),
    ];
});
