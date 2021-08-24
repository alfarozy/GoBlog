@extends('layouts.app')
@section('title', 'Video ')
@section('style')
    <style>
        .article-img {
            height: 230px;
            object-fit: cover;
            object-position: center;
        }

        .img-video-author {
            height: 25px;
            widows: 25px;
            border-radius: 25px;
            border: 0.8px solid gainsboro;
        }

        a:hover {
            text-decoration: none;
        }

        .card-title {
            margin-bottom: -2px;
            margin-top: 10px;
        }

    </style>
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
            height: 25px;
            width: 25px;
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

        .play-playlist-button {
            color: rgba(27, 101, 238, 0.795);
            font-size: 24px
        }

        .box-btn-playlist {
            position: absolute;
            right: 5px;
            bottom: 10px;
            width: 30px;
        }

    </style>
@endsection
@section('content')
    <div class="container my-3">
        <div class="search row mt-3">

            <form action="">
                <div class="form-group float-left mx-1">
                    <select name="type" class="form-control">
                        <option value="video" {{ request()->type == 'video'?'selected':'' }} > Video</option>
                        <option value="playlist" {{ request()->type == 'playlist'?'selected':'' }} > Playlist</option>
                    </select>
                </div>
                <div class="form-group float-left mx-1">
                    <input name="search" type="text" class="form-control" value="{{ request()->search ?? old('search') }}" placeholder="Search...">
                </div>
                
            </form>
        </div>
        <hr class="my-4">
        <div class="row justify-content-start">
            @forelse ($videos as $video)

                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card border-0 shadow-sm">
                        <a href="{{ route('videos.show', $video->slug) }}">
                            <img src="/storage/{{ $video->img }}"
                                style="height:230px;object-fit:cover;object-position:center;" class="card-img-top"
                                alt="...">
                        </a>
                        <div class="card-body text-left">
                            <div class="row jusify-content-end mb-2">
                                <div class="col-md-8 ">
                                    <small>
                                        <a href="{{ route('profile.public',$video->user->email) }}">
                                            <img src="/storage/{{ $video->user->img }}" class="img-video-author" alt=""
                                                srcset="">
                                            {{ \Str::limit($video->user->name, 23, '...') }}</small></a>
                                </div>
                                <div class="col-md-4 text-right">
                                    <small class="text-muted"> {{ $video->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <a class="text-dark" style="margin-bottom: -20px"
                                href="{{ route('videos.show', $video->slug) }}">
                                <h5 class="card-title">{{ \Str::limit($video->title, 80, '...') }}</h5>
                            </a>
                            <small class="text-muted" style="margin-top:-50px!important;">{{ $video->views }} x
                                ditonton</small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="notfound row my-5">
                    <h2>Maaf data tidak ditemukan</h2>
                </div>
            @endforelse

        </div>
        {{ $videos->links('pagination::bootstrap-4')}}
        <hr class="my-3">
        <a class="float-right" href="/playlist">Lihat semua</a>
    <h3>Realted playlist</h3>
    <div class="row justify-content-left">
      @foreach ($playlists as $playlist)
        @if ($playlist->videos->count() != 0  )
            <div class="card col-md-4 border-0">
                <div class="card-header">
                    <div class="card-title">{{ $playlist->title }}</div>
                    </div>
                <div class="card-body">
                    @foreach ($playlist->videos as $index=> $vi)
                        @if ($index < 3)
                        <div class="card border-0 shadow-sm rounded mb-3">
                                <a href="{{ route('videos.show.playlist', ['slug' => $vi->slug, 'playlist' => $playlist->slug]) }}"
                                    class="text-dark text-decoration-none">
                                    <div class="media">
                                        <div class="img-playlist">
                                            <img class="playlist-img" src="/storage/{{ $vi->img }}" width="200">
                                            {{-- @if ($video->slug == $vi->slug)
                                                <div class="box-btn-playlist">
                                                    <i class="play-playlist-button fa fa-play"></i>
                                                </div>
                                            @endif --}}
                                        </div>
                                        <div class="media-body ml-2">
                                            <h6 class="mt-0 "><a class="text-dark"
                                                    href="{{ route('videos.show.playlist', ['slug' => $vi->slug, 'playlist' => $playlist->slug]) }}">
                                                    {{ $vi->title }}
                                                </a>
                                            </h6>
                                            <small class="mb-0 text-muted">{{ $vi->user->name }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                            @if ($index > 3)
                            <div class="text-center">

                                <a class="btn btn-sm btn-primary" href="{{ route('videos.show.playlist', ['slug' => $playlist->videos[0]['slug'], 'playlist' => $playlist->slug]) }}">Semua video</a>
                            </div>
                            @endif
                            @endforeach
                            <hr>

                </div>
            </div>
            
        @endif
      @endforeach
      
    </div>
    </div>
    </div>
@endsection
