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
    {!! session('msg') !!}
    {{-- hapus modal --}}
    <div class="content">
        <div class="row my-4 mx-0 justify-content-center">
            @include('dashboard.nav')

            <div class="col-lg-9 bg-light rounded p-4 px-3">
                <a href="{{ route('profile') }}" class="btn btn-danger "
                    style="position: absolute;right:10px;z-index:99">Batal</a>
                <div class="body mt-4">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('profile.edit') }}">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-lg-3">
                                <img class="img rounded img-thumbnail" id="preview-img" src="/storage/{{ $user->img }}"
                                    alt="Img user">

                                <div class="custom-file my-3">
                                    <input type="file" name="img" class="custom-file-input" id="input-img">
                                    <label class="custom-file-label" for="img-input">Foto Profil</label>
                                </div>

                                <div class="btn-sosial">
                                    <button type="button" class="col-lg-12 my-1 btn btn-primary" data-toggle="modal"
                                        data-target="#sosialMedia" data-link="{{ $user->fb }}" data-sosial="facebook"><i
                                            class="fab fa-facebook"></i>
                                        Facebook</button>
                                    <button type="button" class="col-lg-12 my-1 btn btn-danger" data-toggle="modal"
                                        data-target="#sosialMedia" data-link="{{ $user->ig }}"
                                        data-sosial="instagram"><i class="fab fa-instagram"></i>
                                        Instagram</button>
                                    <button type="button" class="col-lg-12 my-1 btn btn-dark" data-toggle="modal"
                                        data-target="#sosialMedia" data-link="{{ $user->git }}" data-sosial="github"><i
                                            class="fab fa-github"></i>
                                        Github</button>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="fullname">Nama lengkap</label>
                                    <input value="{{ old('name') ?? $user->name }}" type="text" name="name"
                                        class="form-control" id="fullname" placeholder="Fullname">
                                </div>
                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" readonly value="{{ old('email') ?? $user->email }}"
                                        class="form-control" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Bio</label>
                                    <textarea name="bio" class="form-control"
                                        placeholder="Tentang dirimu">{{ $user->bio }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Konfirmasi Password</label>
                                    <input type="password" required name="konfirm_password" class="form-control"
                                        id="exampleInputPassword1" placeholder="Password">
                                    <small class="form-text text-muted">Untuk alasan keamanan silahkan inputkan password
                                        anda</small>

                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="sosialMedia" tabindex="-1" role="dialog" aria-labelledby="sosialLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sosialLabel">Tambah Sosial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="sosialForm" action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="url" name="" placeholder="" class="form-control" id="sosial-name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#input-img').change(function() {
            const file = this.files[0];
            if (file && file.name.match(/\.(jpg|jpeg|png|svg)$/)) {
                let reader = new FileReader();

                reader.onload = function(event) {
                    $('#preview-img').attr('src', event.target.result)
                }

                reader.readAsDataURL(file);
            } else {
                alert('please upload image file');
            }
        });

        $('#sosialMedia').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var sosialMedia = button.data('sosial')
            var link = button.data('link')
            var modal = $(this)
            modal.find('.modal-title').text(sosialMedia)
            modal.find('.modal-body input').val('')
            modal.find('.modal-body input').val(link)
            modal.find('.modal-body input').attr('placeholder', 'Link ' + sosialMedia)
            modal.find('.modal-body input').attr('name', sosialMedia)
            modal.find('#sosialForm').attr('action', '/profile/add/' + sosialMedia)
        })
        setTimeout(function() {
            $('.msg').hide()
        }, 5000);
    </script>
@endsection
