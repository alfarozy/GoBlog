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
        <form action="/blog">
          @csrf
          <input type="text" hidden value="article" name="type" >
          <div class="form-group float-right">
            <input name="q" type="text" class="form-control" placeholder="Search...">
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
  </div>
</div>
@endsection