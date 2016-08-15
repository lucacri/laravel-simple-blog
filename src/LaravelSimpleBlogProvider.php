<?php

namespace Lucacri\LaravelSimpleBlog;

use Illuminate\Support\ServiceProvider;

class LaravelSimpleBlogProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		if (!$this->app->routesAreCached()) {
			require __DIR__ . '/Http/routes.php';
		}
		$this->loadViewsFrom(__DIR__ . '/../assets/views', 'laravel-simple-blog');

		$this->publishes([
							 __DIR__ . '/../assets/views' => base_path('resources/views/lucacri/laravel-simple-blog'),
						 ]);


		$this->publishes([
							 __DIR__ . '/../config/config.php' => config_path('laravel-simple-blog.php'),
						 ]);

		$this->publishes([
							 __DIR__ . '/../database/migrations/' => database_path('migrations')
						 ]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->mergeConfigFrom(
			__DIR__ . '/../config/config.php',
			'laravel-simple-blog'
		);
	}
}
