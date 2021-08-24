@extends('layouts.app')
@section('title', $article->title)
@section('style')
    <style>
        .ck-content {
            height: 100px
        }

        .tag-side {
            font-size: 15px
        }

        .msg {
            position: fixed;
            right: 20px;
            bottom: 10px;
            z-index: 99999;
            background: #37383a;
            color: rgb(241, 236, 236);
            padding: 8px;

        }

        .img-single-article {
            object-fit: cover;
            object-position: center;
            height: 390px;
        }

        @media(max-width:360px) {
            .img-single-article {
                object-fit: cover;
                object-position: center;
                height: 240px;
            }

            h2 {
                font-size: 24px
            }

            .content h2 {
                font-size: 22px
            }

            .content h3 {
                font-size: 18px
            }
        }

        code {
            font-size: 87.5%;

            padding: 2px 9px !important;
        }

        pre {
            color: #e83e8c;
            word-wrap: break-word;
            font-size: 90%;
            color: #2b292a !important;
            background-color: #eeeeee;
            border-radius: 4px;
            padding: 10px
        }

        blockquote {
            background: #eeeeee;
            border-radius: 10px;
            border-left: 4px solid blue;
            border-right: 4px solid blue;
            padding: 15px;
        }

        blockquote::after {
            content: '{{ $article->user->name }}';
            position: absolute;
            right: 60px;
            background: white;
            padding: 5px 10px;
            border-radius: 4px;
            box-shadow: #abab 0px 3px 8px;
        }

        /* .hljs{display:block;overflow-x:auto;padding:0.5em;background:#23241f}.hljs,.hljs-tag,.hljs-subst{color:#f8f8f2}.hljs-strong,.hljs-emphasis{color:#a8a8a2}.hljs-bullet,.hljs-quote,.hljs-number,.hljs-regexp,.hljs-literal,.hljs-link{color:#ae81ff}.hljs-code,.hljs-title,.hljs-section,.hljs-selector-class{color:#a6e22e}.hljs-strong{font-weight:bold}.hljs-emphasis{font-style:italic}.hljs-keyword,.hljs-selector-tag,.hljs-name,.hljs-attr{color:#f92672}.hljs-symbol,.hljs-attribute{color:#66d9ef}.hljs-params,.hljs-class .hljs-title{color:#f8f8f2}.hljs-string,.hljs-type,.hljs-built_in,.hljs-builtin-name,.hljs-selector-id,.hljs-selector-attr,.hljs-selector-pseudo,.hljs-addition,.hljs-variable,.hljs-template-variable{color:#e6db74}.hljs-comment,.hljs-deletion,.hljs-meta{color:#75715e} */

    </style>
@endsection
@section('content')
    <div class="bg-light">
        <div class="container ">
            <div class="row justify-content-between">
                <div class="col-lg-8 my-3">
                    <div class="article px-3 pt-0 bg-white my-3 rounded">

                        {{-- <img width="100%" class="img-single-article rounded my-3 img-fluid" src="{{ asset('img/article/'.$article->img) }}" alt="Img {{ $article->title }}"> --}}
                        <img width="100%" class="img-single-article rounded my-3 img-fluid" src="{{ $article->getImg() }}"
                            alt="Img {{ $article->title }}">

                        <h2>{{ $article->title }}</h2>
                        <div class="info-article">
                            <a class="btn btn-sm btn-{{ $article->category->class }}"
                                href="/category/{{ $article->category->slug }}"> <i class="fas fa-tag text-light"></i>
                                {{ $article->category->name }}</a>
                            <span class="float-right"> <i class="fas fa-calendar-alt"></i>
                                {{ $article->created_at->format('d F, Y') }}</span>
                        </div>
                        <hr>
                        <div class="content px-2">
                            {!! $article->content !!}
                        </div>
                        <div class="views text-right">
                            <small class="text-muted">Views <b>{{ $views }}</b></small>
                        </div>
                        <div class="tags border-top py-4 ">
                            @foreach ($article->tags as $tag)
                                <a class="btn btn-info btn-sm" href="#"><b>#</b>{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    {{-- reply form --}}
                    <div class="row reply-row" style="display: none">
                        @auth

                            <div class="col-lg-12">
                                <form class="form-reply" action="{{ route('add.reply') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <textarea required name="text" class="form-control input-reply"
                                            placeholder="Tambah Reply" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="comment_id" name="comment_id" value="">
                                    </div>
                                    <div class="row float-right">
                                        <button class="btn mx-1 btn-reply btn-sm btn-light "
                                            onclick="$('.reply-row').fadeOut();$('.addReply').fadeIn();"
                                            type="button">batal</button>
                                        <button class="btn mx-1 btn-reply btn-sm btn-success"
                                            onclick="$('.form-reply').submit()" type="submit">Balas</button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="col-lg-12">
                                <h5 class="my-3 text-center">Silahkan <a href="/login">login</a> </h5>
                            </div>
                        @endauth


                    </div>
                    <div class="author bg-white mb-3 p-4 rouded">

                        <div class="media">
                            <a href="{{ route('profile.public',$article->user->email) }}">
                                <img width="90" height="90" src="/storage/{{ $article->user->img }}"
                                class="mr-3 shadow rounded-circle">
                            </a>
                            <div class="media-body">
                                <a href="{{ route('profile.public',$article->user->email) }}">
                                    <h4 class="mt-0 text-muted">{{ $article->user->name }} 
                                    @if ($article->user->hasRole('admin'))
                                    <i style="margin-left:5px;font-size:20px;"
                                    class="fas fa-check-circle text-primary"></i>
                                    @endif
                                    </h4>
                                    </a>
                                <p class="text-muted">{{ $article->user->bio }}</p>
                                <div style="margin-top:-5px !important">
                                    @if ($article->user->fb)
                                        <a href="{{ $article->user->fb }}">
                                            <i style="font-size: 24px" class="text-primary fab mx-1 fa-facebook"></i>
                                        </a>
                                    @endif
                                    @if ($article->user->ig)
                                        <a href="{{ $article->user->ig }}">
                                            <i style="font-size: 24px" class="text-danger fab mx-1 fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if ($article->user->git)

                                        <a href="{{ $article->user->git }}">
                                            <i style="font-size: 24px" class="text-dark fab mx-1 fa-github"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="coment bg-white mb-3 p-4 rouded">
                        {{-- <span class="float-right">{{$comments_count}}</span> --}}
                        <h4 class="text-left">Komentar</h4>
                        <ul class="list-unstyled mt-3">
                            @forelse($article->comments as $comment)
                                <li class="media" id="{{ $comment->id }}">
                                    <a href="{{ route('profile.public',$comment->user->email) }}">
                                        <img src="/storage/{{ $comment->user->img }}" style="height: 50px;width:50px"
                                        class="mr-3 rounded-circle border" alt="User img">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ route('profile.public',$comment->user->email) }}">

                                            <h5 class="mt-0 mb-1">{{ $comment->user->name }}<i
                                                style="margin-left:5px;font-size:18px"
                                                class="fas fa-check-circle text-primary"></i> &middot; <small
                                                class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </h5>
                                        </a>
                                        <div class="text-muted">{!! $comment->text !!}</div>
                                        <button class="btn btn-sm bg-light text-primary addReply float-right "
                                            onclick="reply(this)" id="{{ $comment->id }}">Reply</button>
                                    </div>
                                </li>
                                <ul>
                                    {{-- replies --}}
                                    @foreach ($comment->replies as $reply)
                                        <hr class="border-secondary">
                                        <li class="media" id="{{ $reply->id }}">
                                            <a href="{{ route('profile.public',$reply->user->email) }}">
                                                <img src="/storage/{{ $reply->user->img }}" style="height: 50px;width:50px"
                                                class="mr-3 rounded-circle border" alt="...">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{ route('profile.public',$reply->user->email) }}">
                                                    <h5 class="mt-0 mb-1">{{ $reply->user->name }}<i
                                                        style="margin-left:5px;font-size:18px"
                                                        class="fas fa-check-circle text-primary"></i> &middot; <small
                                                        class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                    </h5>
                                                </a>

                                                <div class="text-muted">{!! $reply->text !!}</div>
                                                <button class="btn btn-sm bg-light text-primary addReply float-right "
                                                    onclick="reply(this)" id="{{ $comment->id }}">Reply</button>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @empty
                                <div class=" text-center p-3">
                                    <h4 class="text-muted">Belum ada yang berkomentar</h4>
                                </div>

                            @endforelse
                        </ul>
                        <div id="bottom-comment"></div>
                    </div>
                    <div class="coment bg-white mb-5 p-2 rouded">
                        @guest
                            <div class="text-center">

                                <h5 class="p-4 text-muted">Silahkan <a href="/login">login</a> untuk menambah komentar</h5>
                            </div>
                        @endguest
                        @auth
                            <h4 class="text-center mb-4">Tambah Komentar</h4>
                            <form action="{{ route('add.comment', $article->slug) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <textarea name="text" class="form-control input-comment" placeholder="Berkomentar"
                                        rows="3"></textarea>
                                    @error('text')
                                        <small class="text-danger">Komentar tidak boleh kosong</small>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>

                        @endauth
                    </div>
                </div>

                <div class="col-lg-4 p-sm-0 px-lg-4  ">
                    <div class="card my-3">
                        <div class="card-header">
                            Kategori
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $category)
                                <li class="list-group-item "><a class="text-{{ $category['class'] }}"
                                        href="/category/{{ $category['slug'] }}">{{ $category['name'] }}</a> <span
                                        class="float-right text-info"> {{ $category->article->count() }}</span></li>

                            @endforeach

                        </ul>
                    </div>
                    {{-- Post by category --}}
                    <div class="card my-3">
                        <div class="card-header">
                            Artikel terkait
                        </div>
                        <div class="card-body-costum p-3">
                            @foreach ($similar_posts as $article)
                                <div class="card mb-2 border-0">
                                    <a href="/article/{{ $article->slug }}">
                                        <img width="120px" src="{{ $article->getImg() }}" class="card-img" alt="...">
                                    </a>
                                    <div class="article-related p-1">
                                        <a class="text-dark" href="/article/{{ $article->slug }}">
                                            <h5>{{ $article->title }}</h5>
                                        </a>
                                        <small class="float-left"><b>{{ $article->views }}</b> x dilihat</small>
                                        <small class="float-right"> <i class="far fa-user"></i>
                                            <a href="{{ route('profile.public',$article->user->email) }}">
                                                {{ $article->user->name }}
                                            </a>
                                        </small>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- tags --}}
                    <div class="card my-3">
                        <div class="card-header">
                            Tags
                        </div>
                        <div class="card-body p-2">
                            @foreach ($tags as $tag)
                                <a class="badge badge-lg tag-side badge-info mt-1">{{ $tag->name }}</a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            {!! session('msg') !!}
        </div>
    </div>

@endsection

@section('script')

<script>
    function reply(r) {
        $('.input-reply').empty()
        $('.reply-row').insertAfter($(r))
        $('.reply-row').fadeIn()
        $('.addReply').fadeIn()
        $(r).hide()
    }
    $('.addReply').click(function() {
        $('.comment_id').val($(this).attr('id'));
    });


    setTimeout(function() {
        $('.msg').hide()
    }, 5000);
</script>
@endsection
