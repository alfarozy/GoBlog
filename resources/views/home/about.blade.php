@extends('layouts.app')
@section('title', 'Tentang kami')
@section('content')
<div class="container my-3">
  <div class="jumbotron">
    
    <div class="container text-center">
      <img class="col-lg-5" src="{{ asset('img/logo2.png') }}" alt="" srcset="">
      <hr class="my-3">
      <div class="row text-center my-3 justify-content-center">
        <div class="card col-lg-7">
          <div class="p-4">
           <p>Kami adalah sebuah platform yang menyediakan artikel dan video tutorial seputar dunia pemograman.</p>
          <b>Kami hadir untuk menambah wawasan sobat gobloger</b>
          <p class="mt-4" >-GoRead-</p>
          <a class="btn btn-md btn-outline-secondary" href="https://github.com/alfarozy/GoBlog"> <i class="fab fa-github"></i> 
            Sourcecode</a>
          </div>
        </div>
      </div>
      <h3 class="mt-5 mb-3" >Dikembangkan Oleh</h3>
       <a href="http://alfarozy.id" target="_blank" rel="noopener noreferrer"> <img width="300px" src="{{ asset('/img/alfarozy.id-black.png') }}" alt="" srcset=""></a>
          <br>
          <a href="https://alfarozy.id/">Logo Kalian disini</a>
          <div class="desc row justify-content-center my-2 mt-5">
            <div class="col-lg-5 bg-light rounded p-3 text-center">
                <p>Semua konten dan <i>Source Code</i> di <b>Alfarozy.id</b> gratis/Open
                    source,
                    dengan begitu bantu saya untuk tetap memberikan layanan gratis ini
                    dengan
                    cara
                </p>
                <p>Klik tombol trakteer dibawah untuk donasi</p>
            </div>
        </div>
        <div class="row text-center justify-content-center mt-3">
            <div class="col-lg-4">
                <a class="btn btn-light" target="_blank"
                    href="https://trakteer.id/alfarozy.id"> <img
                        style="width: 20px!important" src="/img/trakteer.png"
                        alt="" srcset="">
                    Trakteer</a>
            </div>
        </div>
    </div>
  </div>
  <a class="float-right" href="/about">Lihat semua</a>
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
              <small><a href="{{ route('profile.public',$video->user->email) }}" > <i class="fa fa-user-circle" ></i>  {{ $video->user->name }} </small></a>
            </div>
            <div class="col-md-6 text-right">
              <small><a href="#" > <i class="fa fa-calendar-alt" ></i> {{ $video->created_at->diffForHumans() }}</small></a>
            </div>
          </div>
         <a class="text-dark" href="{{ route('videos.show',$video->slug) }}"><h5 class="card-title">{{ \Str::limit($video->title, 80, '...') }}</h5></a>
        </div>
      </div>
    </div>
    
    @endforeach
    
  </div>
</div>
@endsection