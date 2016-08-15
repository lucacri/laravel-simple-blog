@section('head_title', 'Blog - ' . $category . ' | ' . config('laravel-simple-blog.blog_name'))
@section('seo_fields')
    <meta property="og:url" content="{!! Request::fullUrl() !!}"/>
    @if(config('laravel-simple-blog.seo.image'))
        <meta property="og:image" content="{!! config('laravel-simple-blog.seo.image') !!}"/>
    @endif
    @if(config('laravel-simple-blog.seo.title'))
        <meta property="og:title" content="{{ config('laravel-simple-blog.seo.title') }}"/>
    @endif
    @if(config('laravel-simple-blog.seo.description'))
        <meta property="og:description" content="{{ config('laravel-simple-blog.seo.description') }}"/>
    @endif
@endsection


@section('content')

    <section class="big-hero smaller-hero flex dark">
        <div class="row">
            <div class="col-md-12">
                <h1>Category: {{ $category }}</h1>
            </div>
        </div>
    </section>
    <section class="breadcrumbs">
        <div class="row">
            <div class="col-md-12">
                <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
                    <li itemprop="itemListElement" itemscope
                        itemtype="http://schema.org/ListItem">
                        <a itemscope itemtype="http://schema.org/Thing"
                           itemprop="item" href="/blog"
                           class="text-muted">
                            <span itemprop="name">Blog</span>
                        </a>
                        <meta itemprop="position" content="1"/>
                    </li>

                    <li itemprop="itemListElement" itemscope
                        itemtype="http://schema.org/ListItem">
                        <a itemscope itemtype="http://schema.org/Thing"
                           itemprop="item" href="{!! URL::route('blog.show.category', [str_slug($category)]) !!}"
                           class="text-muted">
                            <span itemprop="name">{{ $category }}</span></a>
                        <meta itemprop="position" content="2"/>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <div class="blog">
        @foreach($posts as $post)
            <section class="normal big-section blog-index blog-post">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h2>{{ $post->title }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-inline">
                                <li>By {!! $post->author !!}</li>
                                <li>In
                                    <a href="{!! URL::route('blog.show.category', [str_slug($post->category)]) !!}">{{$post->category}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-right text-muted">
                            {{ $post->created_at }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $post->summary !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{!! $post->url !!}" class="btn btn-success">Read more</a>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach

        <section class="normal">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
