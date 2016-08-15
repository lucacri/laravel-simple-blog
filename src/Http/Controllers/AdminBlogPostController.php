<?php

namespace Lucacri\LaravelSimpleBlog\Http\Controllers;

use Lucacri\LaravelSimpleBlog\BlogPost;
use Lucacri\LaravelSimpleBlog\BlogRepository;
use Lucacri\LaravelSimpleBlog\Exceptions\SlugAlreadySelectedException;
use Lucacri\LaravelSimpleBlog\Requests\UpdateBlogPostRequest;
use Illuminate\Routing\Controller;

class AdminBlogPostController extends Controller
{

	/**
	 * @var BlogRepository
	 */
	private $blogRepository;

	public function __construct(BlogRepository $blogRepository) {


		$this->blogRepository = $blogRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('laravel-simple-blog::admin.index')->with('blogPosts', BlogPost::latest()->get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('laravel-simple-blog::admin.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  UpdateBlogPostRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UpdateBlogPostRequest $request) {

		$data = $request->only((new BlogPost())->getFillable());
		$data['slug'] = str_slug($data['slug']);
		$data['published'] = boolval($data['published']);

		if (BlogPost::where('slug', $data['slug'])->count() > 0) {

		}
		try {
			$newPost = $this->blogRepository->create($data);
		} catch (SlugAlreadySelectedException $e) {
			flash()->error('The same slug has already been used. Try a new one');

			return redirect()->route('admin.blog-posts.create')->withInput();
		}

		flash()->success('Post created!');

		return redirect()->route('admin.blog-posts.edit', [$newPost->id]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		return view('laravel-simple-blog::admin.edit')->with('blogPost', BlogPost::findOrFail($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UpdateBlogPostRequest $request
	 * @param  int                  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateBlogPostRequest $request, $id) {

		/** @var BlogPost $post */
		$post = BlogPost::findOrFail($id);
		$data = $request->only($post->getFillable());
		$data['slug'] = str_slug($data['slug']);
		$data['published'] = boolval($data['published']);

		try {
			$this->blogRepository->update($post, $data);
		} catch (SlugAlreadySelectedException $e) {
			flash()->error('The same slug has already been used. Try a new one');

			return redirect()->route('admin.blog-posts.edit', [$id])->withInput();
		}


		flash()->success('Post updated!');

		return redirect()->route('admin.blog-posts.edit', [$id]);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
