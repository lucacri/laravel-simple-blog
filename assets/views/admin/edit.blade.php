@extends('admin._master')

@section('innerContent')
    <div class="block-header">
        <h2>Blog Post: <a href="{!! $blogPost->url !!}" target="_blank">{{ $blogPost->title }}</a></h2>
    </div>

    <div class="panel">
        <div class="panel-body">
            {!! Former::open()->route('admin.blog-posts.update', [$blogPost->id])->populate($blogPost) !!}
            {!! Former::input('title') !!}
            {!! Former::input('slug')->inlineHelp("The slug should be unique within all the posts") !!}
            {!! Former::input('category') !!}
            {!! Former::input('author')->inlineHelp("Author name displayed on the site") !!}
            {!! Former::email('email')->inlineHelp("Email displayed on the site") !!}

            {!! Former::textarea('markdown')->rows(10) !!}

            {!! Former::checkbox('published')->value(1) !!}

            {!! Former::actions()
                ->large_primary_submit('Edit post')
                ->large_inverse_reset('Reset') !!}
            {!! Former::close() !!}
        </div>
    </div>
@stop



