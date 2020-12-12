<?php

declare(strict_types=1);

namespace App\Providers;

use App\Entity;
use App\Observers\EntityObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Entity::observe(EntityObserver::class);
	}
}
