<?php namespace Lucacri\LaravelSimpleBlog\Tests;

use \Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Lucacri\LaravelSimpleBlog\BlogPost;

class BlogPostTest extends TestCase
{
//	use DatabaseMigrations;
//	use DatabaseTransactions;

//	public function setUp() {
//		// Path to Model Factories (within your package)
//		$pathToFactories = realpath(dirname(__DIR__) . '/../database/factories');
//
//		parent::setUp();
//
//		// This overrides the $this->factory that is established in TestBench's setUp method above
//		$this->factory = Factory::construct(Factory::create(), $pathToFactories);
//
//		// Continue with the rest of setUp for migrations, etc.
//	}

	public function test_url_generator() {
		$post = factory(BlogPost::class)->make(
			['slug'     => 'my-slug',
			 'category' => 'A nice category'
			]
		);

		$this->assertEquals('/blog/a-nice-category/my-slug', $post->url);
	}

	public function test_same_slug() {
		$post = factory(BlogPost::class)->create(
			['slug' => 'my-slug']
		);

		$this->assertEquals(0, BlogPost::withSameSlug($post)->count());

		factory(BlogPost::class)->create(
			['slug' => 'my-slug']
		);

		$this->assertEquals(1, BlogPost::withSameSlug($post)->count());
	}
}
