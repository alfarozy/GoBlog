@extends('layouts.app')
@section('title', $video->title)
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

        .playlist-img {
            object-fit: cover;
            object-position: center;
            height: 90px;
            width: 110px
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

        .img-video-author {
            height: 45px;
            width: 45px;
            border: 0.8px solid gainsboro;
            border-radius: 25px
        }

        .random-video .card-title {
            margin-bottom: -2px;
            margin-top: 10px;
        }

        .random-video .img-video-author {
            height: 25px !important;
            width: 25px !important;
            border: 0.8px solid gainsboro;
            border-radius: 25px
        }

    </style>
@endsection
@section('content')

    <div class="container ">
        <div class="row justify-content-between">
            <div class="col-lg-8 my-3">
                <div class="article shadow-sm px-3 pb-3  pt-0 bg-white my-3 rounded">
                    <section class="wow fadeIn example no-padding no-transition homeBanner">
                        <div id="video" class="hidden-xs loaded">
                            <iframe class="ytplayer-player img-single-article" width="100%" allowfullscreen="1" allow="autoplay" title="YouTube video player"
                                    src="https://www.youtube.com/embed/{{ $video->code_video }}?iv_load_policy=3&modestbranding=0&autoplay=1&controls=0&rel=0&showinfo=0&wmode=opaque&branding=0&autohide=0&loop=1&rel=0&enablejsapi=1&origin=https%3A%2F%2Fhub.youth.gov.ae&widgetid=1"
                                   frameborder="0"></iframe>
                        </div>
                    <h2>{{ $video->title }}</h2>
                    <p class="text-muted">{{ $video->views }} x ditonton</p>
                    <hr>
                    <div class="row justify-content-start">
                        <div class="col-sm-1">
                            <a href="{{ route('profile.public',$video->user->email) }}">
                                <img class="img-video-author" src="/storage/{{ $video->user->img }}" alt="" srcset="">
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <a href="{{ route('profile.public',$video->user->email) }}">
                                <h4 class="text-muted mt-2">{{ $video->user->name }}</h4>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="content px-2">

                        <h5>{{ $video->created_at->format('d F Y') }}</h5>

                        {!! $video->description !!}
                        <div class="tags mt-2">
                            @foreach ($video->tags as $tag)
                                <a href="#"><b>#</b>{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 p-sm-0 px-lg-4 mt-3  ">

                <div class="random-video mt-4">
                    @foreach ($videoRandom as $vr)
                        <div class="card border-0 shadow-sm my-4">
                            <a href="{{ route('videos.show', $vr->slug) }}">
                                <img src="/storage/{{ $vr->img }}"
                                    style="height:230px;object-fit:cover;object-position:center;" class="card-img-top"
                                    alt="...">
                            </a>
                            <div class="card-body text-left">
                                <div class="row jusify-content-end mb-2">
                                    <div class="col-md-8">
                                        <small>
                                            <a href="{{ route('profile.public',$video->user->email) }}">
                                                <img src="/storage/{{ $vr->user->img }}" class="img-video-author" alt=""
                                                    srcset="">
                                                {{ $vr->user->name }}
                                            </a>
                                        </small>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <small class="text-muted"> {{ $vr->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <a class="text-dark" style="margin-bottom: -20px"
                                    href="{{ route('videos.show', $vr->slug) }}">
                                    <h5 class="card-title">{{ $vr->title }}</h5>
                                </a>
                                <small class="text-muted" style="margin-top:-50px!important;">{{ $vr->views }} x
                                    ditonton</small>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
        {!! session('msg') !!}
    </div>

@endsection
