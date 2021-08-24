@extends('layouts.app')
@section('title','Profile '. Auth()->user()->name)
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
<div class="container my-5">
    <div class="container text-center">
        <img width="120" height="120" class="rounded-circle shadow-sm border" src="/storage/{{ $user->img }}" alt="" srcset="">
        <h4 class="mt-3">{{ $user->name }} 
            @if ($user->hasRole('admin'))
                
            <i style="margin-left:5px;font-size:20px;"
            class="fas fa-check-circle text-primary"></i>
            @endif
        </h4>
        <p class="mb-2 text-muted"><b>{{ $user->email }}</b></p>
        <div class=" sosial-media">

            <div class="row justify-content-center">
                @if ($user->fb)
                <a href="{{ $user->fb }}">
                    <i style="font-size: 24px" class="text-primary fab mx-1 fa-facebook"></i>
                </a>
                @endif
                @if ($user->ig)
                    <a href="{{ $user->ig }}">
                        <i style="font-size: 24px" class="text-danger fab mx-1 fa-instagram"></i>
                    </a>
                @endif
                @if ($user->git)

                    <a href="{{ $user->git }}">
                        <i style="font-size: 24px" class="text-dark fab mx-1 fa-github"></i>
                    </a>
                @endif
            </div>
            <div class="row text-center my-3 justify-content-center">
                <div class="card col-lg-7">
                <div class="p-4">
                    {{ $user->bio }}
                </div>
                </div>
            </div>
            <div class="row mt-2 justify-content-center">
                <div class="col-md-3 m-3 card text-center">
                    <div class="card-body my-3">
                    <h5 class="card-title">{{ $user->articles->count() }}</h5>
                    <p class="card-text">Article</p>
                    </div>
                </div>
                <div class="col-md-3 m-3 card text-center">
                    <div class="card-body my-3">
                    <h5 class="card-title">{{ $user->videos->count() }}</h5>
                    <p class="card-text">Video</p>
                    </div>
                </div>
                <div class="col-md-3 m-3 card text-center">
                    <div class="card-body my-3">
                    <h5 class="card-title">{{ $user->playlists->count() }}</h5>
                    <p class="card-text">Playlist</p>
                    </div>
                </div>
            </div>
    </div>
       
  </div>
</div>


@stop