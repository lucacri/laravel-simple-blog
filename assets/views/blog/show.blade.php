@section('head_title', $post->title .  ' | PayPerTrail')
@section('seo_fields')
    <meta property="og:url" content="{!! Request::fullUrl() !!}"/>
    @if(config('laravel-simple-blog.seo.image'))
        <meta property="og:image" content="{!! config('laravel-simple-blog.seo.image') !!}"/>
    @endif
    <meta property="og:url" content="{!! Request::fullUrl() !!}"/>
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:description" content="{{ $post->title }}"/>
    <meta property="og:type" content="article"/>
    <meta name="description" content="{{ $post->title }}">
    <meta property="og:article:published_time" content="{{ $post->created_at->toIso8601String() }}"/>
    <meta property="og:article:author" content="{{ $post->author }}"/>
    <meta property="og:article:section" content=""/>
@endsection


@section('content')
    <section class="big-hero smaller-hero flex dark">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $post->title }}</h1>
                <small>By {{ $post->author }}</small>
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
                           itemprop="item" href="{!! URL::route('blog.show.category', [str_slug($post->category)]) !!}"
                           class="text-muted">
                            <span itemprop="name">{{ $post->category }}</span></a>
                        <meta itemprop="position" content="2"/>
                    </li>
                    <li itemprop="itemListElement" itemscope
                        itemtype="http://schema.org/ListItem">
                        <a itemscope itemtype="http://schema.org/Thing"
                           itemprop="item"
                           href="{!! $post->url !!}"
                           class="text-muted">
                            <span itemprop="name">{{ $post->title }}</span>
                        </a>
                        <meta itemprop="position" content="3"/>
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <div class="blog">
        <section class="normal big-section blog-post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{ $post->created_at }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! $post->html !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascripts')
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{!! Request::fullUrl() !!}"
  },
  "headline": {{ json_encode($post->title) }}",
  "datePublished": "{{ $post->created_at->toIso8601String() }}",
  "dateModified": "{{ $post->created_at->toIso8601String() }}",
  "author": {
    "@type": "Person",
    "name": "{{ $post->author }}"
  },
   "publisher": {
    "@type": "Organization",
    "name": "{!! config('laravel-simple-blog.seo.site_name') !!}",
    "logo": {
      "@type": "ImageObject",
      "url": "{!! config('laravel-simple-blog.seo.image') !!}",
      "width": 600,
      "height": 60
    }
  },
  "description": {{ json_encode($post->summary) }}
        }

    </script>
@append
