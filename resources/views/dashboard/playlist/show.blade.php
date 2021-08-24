@extends('layouts.app')
@section('title', 'Dashboard | Playlists Video')
@section('style')
    <link rel="stylesheet" href="/css/select2.min.css">

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
    <div class="modal fade" id="konfirm" tabindex="-1" role="dialog" aria-labelledby="konfirmLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmLabel">Hapus Video Dari Playlist ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- action form nya di ubah --}}
                <form action="" class="form-konfirm" method="post">
                    @method('delete')
                    @csrf
                    <div class="row justify-content-end px-4 py-3">
                        <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger mx-2" type="submit"
                            onclick="$('.form-konfirm').submit()">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row my-4 mx-0 justify-content-center">
            @include('dashboard.nav')
            <div class="col-lg-9 bg-light rounded py-4 px-3">

                <h3>Playlist <span class="text-muted">{{ $playlist->title }}</span></h3>
                <div class="body mt-4">
                    <table class="table table-sm table-borderless col-lg-4">
                        <tbody>
                            <tr>
                                <th scope="row">Author</th>
                                <td>:</td>
                                <td>{{ $playlist->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal</th>
                                <td>:</td>
                                <td>{{ $playlist->created_at->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Video</th>
                                <td>:</td>
                                <td>{{ $playlist->videos->count() }} video</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-sm ">
                        <thead>
                            <tr class="border-0">
                                <th scope="col">#</th>
                                <th scope="col" width="70%">Judul Video</th>
                                <th scope="col">Hapus dari Playlist</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($playlist->videos as $video)

                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a
                                            href="{{ route('videos.show.playlist', ['slug' => $video->slug, 'playlist' => $playlist->slug]) }}">{{ $video->title }}</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm hapus btn-link"
                                            data-action="{{ route('playlists.removeVideo', ['video_id' => $video->id, 'slug' => $playlist->slug]) }}"
                                            data-toggle="modal" data-target="#konfirm">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-center ">
                                <th class="border-0" colspan="2">
                                    <a href="#" data-toggle="modal" data-target="#addVideo"> <i class="fa fa-plus"></i>
                                        Tambah Video ke playlist</a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="addVideoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVideoLabel">Tambah Video Ke Playlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('playlists.addVideo', $playlist->slug) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <select name="video_id[]" style="width: 100%" multiple class="form-control col-lg-12"
                                id="video">
                                @forelse ($videos as $video)
                                    <option value="{{ $video->id }}">{{ $video->title }}</option>
                                @empty
                                    <option disabled> Tidak Ada Video</option>
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="/js/select2.min.js"></script>

<script>
    $("#video").select2({
        tags: true,
        placeholder: 'Pilih Video'
    })
    $('.hapus').click(function() {
        var action = $(this).data('action')
        $('.form-konfirm').attr('action', action);
    })

    setTimeout(function() {
        $('.msg').hide()
    }, 5000);
</script>
@endsection
