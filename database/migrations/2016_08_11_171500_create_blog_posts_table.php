<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('blog_posts',
			function (Blueprint $table) {
				$table->increments('id');
				$table->text('slug')->index();
				$table->text('title');
				$table->text('markdown');
				$table->boolean('published')->default(FALSE);
				$table->text('author');
				$table->text('email');
				$table->text('category');
				$table->text('category_slug')->index();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('blog_posts');
	}
}
