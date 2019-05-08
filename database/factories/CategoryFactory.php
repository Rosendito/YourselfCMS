<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	$title = $faker->unique()->sentence(rand(1, 3));

    return [
        'name'       => $title,
        'slug'       => str_slug($title),
        'description' => $faker->text(500),
    ];
});
