@extends('admin._master')

@section('innerContent')
    <div class="block-header">
        <h2>Blog Posts</h2>
    </div>

    <a href="{!! URL::route('admin.blog-posts.create') !!}" class="btn btn-primary">Create a new blog post</a>

    <div class="panel">
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>URL</th>
                    <th>Author</th>
                    <th>Date Published</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogPosts as $blogPost)
                    <tr>
                        <td>{{ $blogPost->title }}</td>
                        <td>{{ $blogPost->category }}</td>
                        <td><a href="{!! $blogPost->url  !!}">URL</a></td>
                        <td>{{ $blogPost->author }}</td>
                        <td>{{ $blogPost->created_at }}</td>
                        <td>{{ ($blogPost->published ? "Published": "Draft")}}</td>
                        <td>
                            <a href="{!! URL::route('admin.blog-posts.edit', [$blogPost->id]) !!}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
