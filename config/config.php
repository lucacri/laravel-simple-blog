<?php


return [

	'blog_name' => env('BLOG_NAME', 'Blog'),

	'seo' => [
		'image' => env("BLOG_SEO_IMAGE", NULL),
		'title' => env("BLOG_SEO_TITLE", NULL),
		'description' => env("BLOG_SEO_DESCRIPTION", NULL),
		'site_name' => env("BLOG_SEO_SITE_NAME", NULL),
	]

];
