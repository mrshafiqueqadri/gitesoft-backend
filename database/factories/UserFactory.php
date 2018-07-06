<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('admin1'), // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\models\Country::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\models\Genre::class, function (Faker $faker) {
    return [
        'title' => $faker->name
    ];
});

$factory->define(App\models\Film::class, function (Faker $faker) {
	$name = $faker->name;
    $movie = array("ridick.jpg", "starwar.jpg", "wanted.jpg", 'mi.jpeg');
    $rand_keys = array_rand($movie, 2);

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description'=> $faker->paragraph,
        'genre_id' => random_int(1,10),
        'country_id' => random_int(1,10),
        'release_date' => now(),
        'price' => random_int(100, 500),
        'photo' => $movie[$rand_keys[0]],
    ];
});

$factory->define(App\models\FilmComment::class, function (Faker $faker) {
    return [
        'film_id' => random_int(1,10),
        'body' => $faker->name,
        'user_id' => random_int(1, 10)
    ];
});

$factory->define(App\models\FilmRating::class, function (Faker $faker) {
	return [
		'film_id' => random_int(1,10),
        'user_id' => random_int(1,10),
        'rating' => random_int(1,5),
    ];
});
