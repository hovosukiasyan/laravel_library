<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->city,
        'author' => $faker->lastName,
        'year' => $faker->numberBetween(1800,2020)
    ];
});
