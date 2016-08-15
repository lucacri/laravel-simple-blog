<?php namespace Lucacri\LaravelSimpleBlog;

use Illuminate\Cache\Repository as Cache;

class BlogRepository
{
	/**
	 * @var Cache
	 */
	private $cache;

	/**
	 * BlogRepository constructor.
	 *
	 * @param Cache $cache
	 */
	public function __construct(Cache $cache) {

		$this->cache = $cache;
	}

	public function update(BlogPost $post, $data = []) {
		$post->fill($data);

		if (BlogPost::withSameSlug($post)->count() > 0) {
			throw new SlugAlreadySelectedException();
		}
		$post->save();

		$this->cache->forget('blog-post-' . $post->id . '-html');
		$this->cache->forget('blog-post-' . $post->id . '-summary');
	}

	public function create($data = []) {
		if (BlogPost::where('slug', $data['slug'])->count() > 0) {
			throw new SlugAlreadySelectedException();
		}

		return BlogPost::create($data);
	}

	public function paginated() {
		return BlogPost::published()->orderBy('created_at', 'desc')->simplePaginate(5);
	}

	public function byCategory($category) {
		return BlogPost::published()->byCategory($category)->orderBy('created_at', 'desc')->simplePaginate(5);
	}

	public function getBySlug($slug) {
		$post = BlogPost::whereSlug($slug)->firstOrFail();

		return $post;
	}


}
