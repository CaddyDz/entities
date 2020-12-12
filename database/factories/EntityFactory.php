<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity;
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

$factory->define(Entity::class, fn (Faker $faker) =>
[
	'name' => $faker->word,
	// https://github.com/fzaninotto/Faker#fakerproviderbarcode
	'barcode' => $faker->ean13,
	'description' => $faker->realText(),
]);
