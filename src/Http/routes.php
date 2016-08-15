<?php

// Public facing routes
Route::group(['as' => 'blog.', 'prefix' => '/blog/'],
	function () {
		Route::get('/', ['as' => 'index', 'uses' => 'Lucacri\LaravelSimpleBlog\Controllers\BlogController@index']);
		Route::get('{category}',
				   ['as' => 'show.category',
					'uses' => 'Lucacri\LaravelSimpleBlog\Controllers\BlogController@showCategory']);
		Route::get('{category}/{slug}',
				   ['as' => 'show', 'uses' => 'Lucacri\LaravelSimpleBlog\Controllers\BlogController@show']);
	});



Route::group(['middleware' => ['web', 'auth', 'auth.admin'], 'prefix' => 'admin/'],
	function () {
		Route::resource('blog-posts', 'Lucacri\LaravelSimpleBlog\Controllers\AdminBlogPostController');
	});
