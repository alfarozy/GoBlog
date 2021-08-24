@extends('layouts/app')
@section('title', 'Dashboard')
@section('style')
    <style>
        .msg {
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
    {{-- hapus modal --}}
    {!! session('msg') !!}

    <div class="content">
        <div class="row my-4 mx-0 justify-content-center">
            @include('dashboard.nav')
            <div class="col-lg-9 bg-light rounded p-4 px-3">
                <a href="{{ route('profile.edit') }}" class="btn btn-info "
                    style="position: absolute;right:10px;z-index:99">Edit profil</a>
                <div class="body mt-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <img class="img rounded img-thumbnail" src="/storage/{{ $user->img }}" alt="Img user">
                        </div>
                        <div class="col-lg-9">
                            <h3>{{ $user->name }}<i style="margin-left:5px;font-size:23px;"
                                    class="fas fa-check-circle text-primary"></i></h3>
                            <p class="text-muted">{{ $user->email }}</p>
                            <div class="mt-3">
                                <div style="margin-top:-5px !important">
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
                                <div class="mt-3 col-sm-12 col-md-8 ml-0 pl-0">
                                    <span>BIO</span>
                                    <p class="text-muted">{{ $user->bio }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
    @section('script')
        <script>
            setTimeout(function() {
                $('.msg').hide()
            }, 5000);
        </script>
    @endsection
