<?php

namespace Lucacri\LaravelSimpleBlog\Http\Controllers;

use Lucacri\LaravelSimpleBlog\BlogRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller
{
	/**
	 * @var BlogRepository
	 */
	private $blogRepository;

	public function __construct(BlogRepository $blogRepository) {

		$this->blogRepository = $blogRepository;
	}

	public function index() {
		$posts = $this->blogRepository->paginated();

		return view('laravel-simple-blog::blog.index')->withPosts($posts);
	}

	public function showCategory($category) {

		$posts = $this->blogRepository->byCategory($category);
		if(count($posts) == 0){
			throw new NotFoundHttpException();
		}

		$category = $posts->first()->category;

		return view('laravel-simple-blog::blog.category')->withPosts($posts)->withCategory($category);
	}


	public function show($category, $slug) {
		$post = $this->blogRepository->getBySlug($slug);

		return view('laravel-simple-blog::blog.show')->withPost($post);
	}


}
