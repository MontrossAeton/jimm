<?php

use Illuminate\Support\Str;
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

$factory->define(App\Gym::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'branch' => $faker->city." Branch",
        'street' => $faker->streetName,
        'city' => $faker->city,
        'landline' => $faker->tollFreePhoneNumber,
        'mobile' => $faker->phoneNumber,
        'website' => 'http://www.google.com',
        'long' => $faker->longitude(120, 121),
        'lat' => $faker->latitude(14, 15),
        'status' => 1,
    ];
});
