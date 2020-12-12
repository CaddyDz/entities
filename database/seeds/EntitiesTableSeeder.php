<?php

declare(strict_types=1);

use App\Entity;
use Illuminate\Database\Seeder;

class EntitiesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Create 10 parent entities
		factory(Entity::class, 10)->create()->each(function ($entity) {
			// Randomly decide whether to create a parent or not
			$toss = rand(0, 1);
			$toss ? $entity->children()->createMany(
				factory(Entity::class, rand(1, 10))->make()->toArray()
			)->each(function ($child) { // Seed second level
				$toss = rand(0, 1);
				$toss ? $child->children()->createMany(factory(Entity::class, rand(1, 10))->make()->toArray()) : '';
			}) : '';
		});
	}
}
