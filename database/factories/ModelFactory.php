<?php
use Lucacri\LaravelSimpleBlog\BlogPost;

$factory->define(BlogPost::class,
	function ($faker) {
		return [
			'slug'       => $faker->slug,
			'title'      => $faker->words(rand(2, 10), TRUE),
			'markdown'   => $faker->paragraphs(2, TRUE),
			'published'  => TRUE,
			'author'     => $faker->name,
			'email'      => $faker->email,
			'category'   => $faker->words(3, TRUE),
			'created_at' => $faker->dateTimeBetween('-2 months')
		];
	});
