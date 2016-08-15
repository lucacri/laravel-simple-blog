<?php

namespace Lucacri\LaravelSimpleBlog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return TRUE;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'slug'      => 'required',
			'title'     => 'required',
			'markdown'  => 'required',
			'published' => 'boolean',
			'author'    => 'required',
			'email'     => 'required|email',
			'category'  => 'required'
		];
	}
}
