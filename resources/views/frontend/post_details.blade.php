@extends('frontend.master')
@section('content')
    <!--post-single-->
    <section class="post-single">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-lg-12">
                    <!--post-single-image-->
                    <div class="post-single-image">
                        <div class="post-single-image">
                            <img src="{{ asset('uploads/post/preview') }}/{{ $post->preview }}" alt="">
                        </div>

                        <div class="post-single-body">
                            <!--post-single-title-->
                            <div class="post-single-title">
                                <h2> {{ $post->title }}</h2>
                                <ul class="entry-meta">
                                    <li class="post-author-img">
                                        @if ($post->rel_to_author->photo != null)
                                            <img src="{{ asset('uploads/author/' . $post->rel_to_author->photo) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('frontend_asset') }}/img/author/1.jpg" alt="">
                                        @endif
                                    </li>
                                    <li class="post-author"> <a
                                            href="{{ route('author.post', $post->author_id) }}">{{ $post->rel_to_author->name }}</a>
                                    </li>
                                    <li class="entry-cat"> <a href="{{ route('category.post', $post->category_id) }}"
                                            class="category-style-1 "> <span class="line"></span>
                                            {{ $post->rel_to_category->category_name }}</a></li>
                                    <li class="post-date"> <span class="line"></span>
                                        {{ $post->created_at->diffForHumans() }}</li>
                                </ul>

                            </div>

                            <!--post-single-content-->
                            <div class="post-single-content">
                                {!! $post->desp !!}
                            </div>


                            <!--post-single-bottom-->
                            <div class="post-single-bottom">
                                <div class="tags">
                                    @php
                                        $after_explode = explode(',', $post->tags);
                                    @endphp
                                    <p>Tags:</p>
                                    <ul class="list-inline">
                                        @foreach ($after_explode as $tag)
                                            <li>
                                                <a
                                                    href="{{ route('tag.post', App\models\Tag::where('id', $tag)->first()->id) }}">{{ App\models\Tag::where('id', $tag)->first()->tag_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- //share social media --}}
                                {{-- <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>                       --}}
                                <div class="social-media">
                                    <p>Share on :</p>
                                    <ul class="list-inline">
                                        {{-- <li>
                                        <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li> --}}
                                        {!! Share::currentPage()->facebook()->twitter()->linkedin('Extra linkedin summary can be passed here')->whatsapp() !!}


                                    </ul>
                                </div>








                            </div>

                            <!--post-single-author-->
                            <div class="post-single-author ">
                                <div class="authors-info">
                                    <div class="image">
                                        <a href="{{ route('author.post', $post->author_id) }}" class="image">
                                            @if ($post->rel_to_author->photo != null)
                                                <img src="{{ asset('uploads/author/' . $post->rel_to_author->photo) }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('frontend_asset') }}/img/author/1.jpg" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>{{ $post->rel_to_author->name }}</h4>
                                        <p> It is my favorite Blog Site</p>
                                        <div class="social-media">
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--post-single-comments-->
                            <div class="post-single-comments">
                                <!--Comments-->
                                <h4>3 Comments</h4>
                                <ul class="comments">
                                    @foreach ($comments as $comment)
                                        <!--comment1-->
                                        <li class="comment-item pt-0 border-0">
                                            @if ($comment->rel_to_author->photo != null)
                                                <img src="{{ asset('uploads/author') }}/{{ $comment->rel_to_author->photo }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('frontend_asset') }}/img/other/user1.jpg"
                                                    alt="">
                                            @endif
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a
                                                                href="{{ route('author.post', $post->author_id) }}">{{ $comment->rel_to_author->name }}</a>
                                                        </li>
                                                        <li class="slash"></li>
                                                        <li>{{ $comment->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $comment->comments }}</p>
                                                <a onclick="toggleReplyForm({{ $comment->id }})" class="btn-reply"><i
                                                        class="las la-reply"></i> Reply</a>

                                                <!--Reply form-->
                                                {{-- <form id="form-main" class="d-none" action="{{ route('comment.store') }}" method="POST" >
                                    @csrf
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="comments"  cols="30" rows="2" class="form-control" placeholder="Message*" required="required"></textarea>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-12">
                                            <button type="submit" name="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div> 
                                    </div>
                                </form> --}}



                                                <div class="reply-form" id="reply-form-{{ $comment->id }}"
                                                    style="display:none;">
                                                    <form class="form" action="{{ route('comment.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                                
                                                                <textarea name="comments" cols="30" rows="2" class="form-control" placeholder="Message*" required="required"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="submit" name="submit" class="btn-custom">reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--/-->
                                        </li>
                                        @foreach ($comment->replies as $reply )
                                             <!--comment1-->
                                        <li class="comment-item pt-0 border-0" style="margin-left:100px">
                                            @if ($reply->rel_to_author->photo != null)
                                                <img src="{{ asset('uploads/author') }}/{{ $reply->rel_to_author->photo }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('frontend_asset') }}/img/other/user1.jpg"
                                                    alt="">
                                            @endif
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a
                                                                href="{{ route('author.post', $post->author_id) }}">{{ $reply->rel_to_author->name }}</a>
                                                        </li>
                                                        <li class="slash"></li>
                                                        <li>{{ $reply->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $reply->comments }}</p>
                                                <a onclick="toggleReplyForm({{ $reply->id }})" class="btn-reply"><i
                                                        class="las la-reply"></i> Reply</a>
                                                        <div class="reply-form" id="reply-form-{{ $reply->id }}"
                                                    style="display:none;">
                                                    <form class="form" action="{{ route('comment.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                                
                                                                <textarea name="comments" cols="30" rows="2" class="form-control" placeholder="Message*" required="required"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="submit" name="submit" class="btn-custom">reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--/-->
                                        </li>
                                        @endforeach
                                    @endforeach



                                </ul>
                                <!--Leave-comments-->
                                @auth('author')
                                    <div class="comments-form" id="com-form">
                                        <h4>Leave a Reply</h4>
                                        <!--form-->
                                        <form class="form " action="{{ route('comment.store') }}" method="POST">
                                            @csrf
                                            <p>Your email adress will not be published ,Requied fileds are marked*.</p>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                        <input type="text" class="form-control" placeholder="Name*"
                                                            required="required"
                                                            value="{{ Auth::guard('author')->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" placeholder="Email*"
                                                            required="required"
                                                            value="{{ Auth::guard('author')->user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="comments" cols="30" rows="5" class="form-control" placeholder="Message*"
                                                            required="required"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <button type="submit" name="submit" class="btn-custom">
                                                        Send Comment
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/-->
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection




@section('footer_script')
    <script>
        function toggleReplyForm(commentId) {
            const form = document.getElementById('reply-form-' + commentId);
            if (form.style.display == 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
@endsection
