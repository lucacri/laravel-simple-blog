<?php namespace Lucacri\LaravelSimpleBlog\Tests;

use Illuminate\Database\Eloquent\Factory;

class TestCase extends \Orchestra\Testbench\TestCase
{

	public function setUp()
	{
		parent::setUp();

		$this->withFactories(__DIR__ . '/../database/factories');
		$this->artisan('migrate', [
			'--database' => 'testpackage',
			'--realpath' => realpath(__DIR__.'/../database/migrations'),
		]);


	}

	protected function getEnvironmentSetUp($app) {

		$app['config']->set('database.default', 'testpackage');

		$app['config']->set('database.connections.testpackage',
							[

								'driver' => 'sqlite',

								'database' => ':memory:',

								'prefix' => '',

							]);
	}

	protected function getPackageProviders($app)
	{
		return ['Lucacri\LaravelSimpleBlog\LaravelSimpleBlogProvider'];
	}
}
