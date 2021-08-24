@extends('layouts/app')
@section('title','Dashboard | Playlist video')
@section('style')
    <style>
      .msg{
            position: fixed;
            right: 20px;
            bottom: 10px;
            z-index: 99999;
            background: #37383a;
            color: rgb(241, 236, 236);
            padding: 8px;
            
          }
    </style>
@endsection
@section('content')
{!! session('msg') !!}

<div class="content">
    <div class="row my-4 mb-5 mx-0 justify-content-center">
       @include('dashboard.nav')
        <div class="col-lg-9 bg-light rounded py-4 px-3">
            <h3>Edit Playlist</h3>
            <div class="body mt-4 p-3">
                <form method="POST" action="{{ route('playlists.update',$playlist->slug) }}" >
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="playlist">Playlist</label>
                            <input autofocus name="title" id="playlist" autocomplete="off" autofocus type="text" value="{{ old('title') ?? $playlist->title }}" class="form-control" placeholder="Nama Playlist">
                            @error('title')
                                <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="btn-submit mt-4 text-center">
                            <button class="btn btn-success col-lg-5 mt-5 mb-5" type="submit">Submit</button>
                        </div>
                </form>
                    
                
            </div>
        </div>

    </div>
</div>
@endsection