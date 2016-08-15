<?php namespace Lucacri\LaravelSimpleBlog;

use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\Converter;


class BlogPost extends Model
{
	protected $fillable = [
		'slug',
		'title',
		'markdown',
		'published',
		'author',
		'email',
		'category'
	];

	protected $casts = [
		'published' => 'boolean',
	];

	protected $appends = ['url', 'html'];

	public function getUrlAttribute() {
		return app('url')->route('blog.show', ['category' => str_slug($this->category), 'title' => $this->slug]);
	}


	public function setCategoryAttribute($value) {
		$this->attributes['category'] = $value;
		$this->attributes['category_slug'] = str_slug($this->category);
	}

	public function scopeWithSameSlug($query, BlogPost $otherPost) {
		return $query->where('slug', $otherPost->slug)->where('id', '<>', $otherPost->id);
	}

	public function scopePublished($query) {
		return $query->where('published', TRUE);
	}

	public function scopeByCategory($query, $category) {
		return $query->where('category_slug', $category);
	}

	public function getHtmlAttribute() {
		return app(CacheRepository::class)->rememberForever('blog-post-' . $this->id . '-html',
			function () {
				/** @var Converter $converter */
				$converter = app(Converter::class);

				return $converter->convertToHtml($this->markdown);
			});

	}

	public function getSummaryAttribute() {
		return app(CacheRepository::class)->rememberForever('blog-post-' . $this->id . '-summary',
			function () {
				$stripped = strip_tags($this->html);
				/** @var Converter $converter */
				$converter = app(Converter::class);

				return $converter->convertToHtml(
					str_replace("\n",
								"\r\n",
								Str::words($stripped, 100, '')
					)
				);
			});
	}
}
