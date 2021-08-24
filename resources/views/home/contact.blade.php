@extends('layouts.app')
@section('title','Hubungi kami')
@section('style')
<style>
  .sosial-media a{
    font-size: 22px !important
  }
  .sosial-media li{
    display: inline-block; 
    margin: 9px 3px;
  }

</style>
@stop
@section('content')
<div class="container my-3">
    <div class="jumbotron">
      <h3 class="d-flex">Hubungi admin</h3>
      <hr class="my-4">

      <div class="container text-center">
            <img width="120" height="120" class="rounded-circle" src="{{ asset('img/oji2.png') }}" alt="" srcset="">
            <h4 class="mt-3">Alfarozy AN</h4>
            <p class="mb-2 text-muted"><b>mr.alfarozy.a.n@gmail.com</b></p>
            <div class=" sosial-media">

              <div class="row justify-content-center">
                <a class="mx-2" href="https://www.facebook.com/Alfarozy.A.n/"> <i class="fab fa-facebook" ></i></a>
                <a class="mx-2" href="https://wa.me/+6281268174381"> <i class="text-success fab fa-whatsapp" ></i></a>
                <a class="mx-2" href="https://www.instagram.com/alfarozy_an"> <i class="text-danger fab fa-instagram" ></i></a>
              </div>
              <div class="row text-center my-3 justify-content-center">
                <div class="card col-lg-7">
                  <div class="p-4">
                    Hubungi admin lewat email atau click salah satu ikon sisoal media diatas
                  </div>
                  <div class="p-4">
                   <strong>Program Anda Dilanda Error ?<br> <span class="text-muted" >Digoblog-in aja</span></strong>
                  </div>
                </div>
              </div>

        </div>
           
      </div>
    </div>
</div>


@stop