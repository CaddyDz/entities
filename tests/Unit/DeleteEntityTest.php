<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteEntityTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Test entities can be deleted
	 *
	 * @return void
	 */
	public function testEntitiesCanBeDeleted(): void
	{
		$entity = [
			'name' => 'entity1',
			'barcode' => 1234567849,
			'description' => 'testing deletion',
		];
		$response = $this->json('POST', 'api/entities', $entity);
		$response
			->assertStatus(201)
			->assertJson([
				'status' => 'success',
			]);
		$response = $this->json('DELETE', 'api/entities/{id}', ['id' => 1]);
			
		$response
			->assertStatus(204);
			
	}
}
