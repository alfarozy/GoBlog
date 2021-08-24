@extends('layouts.app')
@section('title', 'Beranda')
@section('style')
    <style>
      .article-img {
        height:230px;object-fit:cover;object-position:center;
      }
    </style>
@endsection
@section('content')
<div class="container my-3">
  <div class="jumbotron">
    <div class="row">
      <div class="col-lg-4">
        @isset($category)
        <h3 class="d-flex">Kategori : {{ $category->name }}</h3>
        @else
        <h3 class="d-flex">Postingan Terbaru</h3>
        @endisset
      </div>
      <div class="col-lg-8">
        <form action="">
          <div class="form-group float-right mx-1">
            <input name="search" type="text" class="form-control" placeholder="Search...">
          </div>
          <div class="form-group float-right mx-1">
            <select name="type" class="form-control">
              <option value="article" selected> Article</option>
              <option value="video" selected> Video</option>
            </select>
          </div>
        </form>
      </div>
    </div>

    <hr class="my-4">
    <div class="row justify-content-start">
      @foreach($articles as $article)
        
      <div class="col-sm-12 col-md-6 col-lg-4 my-3">
        <div class="card" >
          <a href="/article/{{ $article->slug }}">
            <img src="{{ $article->getImg() }}" class="img article-img card-img-top" alt="...">
          </a>
          <div class="card-body text-left">
            <a href="/article/{{ $article->slug }}">
              <h5 class="card-title">{{ $article->title }}</h5>
            </a>
            <a style="position: absolute;top:0;left:0" class="shadow btn btn-sm btn-{{$article->category->class}} mt-0" href="/category/{{ $article->category->slug }}"><i class="fas fa-tag text-light" ></i> {{ $article->category->name}}</a>
          <p class="card-text">{{ $article->description }}</p>
         
          </div>
        </div>
      </div>
      @endforeach
      {{ $articles->links('pagination::bootstrap-4')}}
      </div>
    </div>
    <a class="float-right" href="/video">Lihat semua</a>
    <h3>Realted video</h3>
    <div class="row justify-content-center">
      @foreach ($videos as $video)
      <div class="col-sm-12 col-md-4 my-3">
        <div class="card" >
          <a href="{{ route('videos.show',$video->slug) }}">
            <img src="/storage/{{ $video->img }}" style="height:230px;object-fit:cover;object-position:center;"  class="card-img-top" alt="...">
          </a>
          <div class="card-body text-left">
            <div class="row jusify-content-end mb-2">
              <div class="col-md-6">
                <small><a href="#" > <i class="fa fa-user-circle" ></i>  {{ $video->user->name }} </small></a>
              </div>
              <div class="col-md-6 text-right">
                <small><a href="#" > <i class="fa fa-calendar-alt" ></i> {{ $video->created_at->diffForHumans() }}</small></a>
              </div>
            </div>
           <a class="text-dark" href="{{ route('videos.show',$video->slug) }}"><h5 class="card-title">{{ \Str::limit($video->title, 35, '...') }}</h5></a>
          </div>
        </div>
      </div>
      
      @endforeach
      
    </div>
  </div>
</div>
@endsection