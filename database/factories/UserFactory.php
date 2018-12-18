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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
  //       'name' => $faker->name,
  //       'email' => $faker->unique()->safeEmail,
  //       'department_id' => 1,
		// 'position_id' => 1,
  //       'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
  //       'remember_token' => str_random(10),



        'firstname' => $faker->name,
		'lastname' => $faker->name,
		'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'department_id' => 1,
        'position_id' => 1,
        'email_verified_at' => date('Y-m-d H:i:s')
    ];
});
