@extends('frontend.master')
@section('content')
<!-- Section Heading -->
<div class="section-heading">
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title">
                        <h1>Blogs</h1>
                        <p class="links"><a href="{{ route('index') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<!-- Blog Layout-2-->
<section class="blog-layout-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"> 
                @foreach($posts as $post)
                    <!-- Each Post -->
                    <div class="post-list post-list-style2">
                        <div class="post-list-image" style="width:45%">
                            <a href="{{ route('post.details', $post->slug) }}">
                                <img src="{{ asset('uploads/post/thumbnail') }}/{{ $post->thumbnail }}" alt="" >
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="{{ route('post.details', $post->slug) }}">{{ $post->title }}</a>
                            </h3>  
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                    @if ($post->rel_to_author->photo != null) 
                                    <img src="{{ asset('uploads/author/',$post->rel_to_author->photo) }}" alt="">
                                @else
                                    <img src="{{ asset('frontend_asset/img/author/1.jpg') }}" alt="">  
                                @endif
                                </li>
                                <li class="post-author"> <a href="{{ route('author.post',$post->author_id) }}">{{ $post->rel_to_author->name }}</a></li>
                                <li class="entry-cat"> <a href="{{ route('category.post',$post->category_id) }}" class="category-style-1 "><span class="line"></span>{{ $post->rel_to_category->category_name }} </a></li>
                             <li class="post-date"> <span class="line"></span> {{ $post->created_at->diffForHumans() }}</li>
                            </ul>
                            <div class="post-excerpt">
                                <p>{!! Str::limit(strip_tags($post->desp), 150) !!}</p>
                            </div>
                            
                            <div class="post-btn">
                                <a href="{{ route('post.details', $post->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection