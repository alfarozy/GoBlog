@extends('layouts.app')
@section('title', 'Publis Video')
@section('style')
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="stylesheet" href="/css/tagsinput.css">
    <style>
        .ck-content {
            height: 350px
        }

        .selectgroup {
            display: -ms-inline-flexbox;
            display: inline-flex
        }

        .selectgroup-item {
            -ms-flex-positive: 1;
            flex-grow: 1;
            position: relative;
            font-weight: 400 !important
        }

        .selectgroup-item+.selectgroup-item {
            margin-left: -1px
        }

        .selectgroup-item:not(:first-child) .selectgroup-button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .selectgroup-item:not(:last-child) .selectgroup-button {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .selectgroup-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0
        }

        .selectgroup-button {
            display: block;
            border: 1px solid rgba(0, 40, 100, .12);
            text-align: center;
            padding: .375rem 1rem;
            position: relative;
            cursor: pointer;
            border-radius: 3px;
            color: #9aa0ac;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-size: 14px;
            line-height: 1.5rem;
            min-width: 2.375rem
        }

        .selectgroup-button-icon {
            padding-left: .5rem;
            padding-right: .5rem;
            font-size: 1rem
        }

        .selectgroup-input:checked+.selectgroup-button {
            border-color: #1572e8;
            z-index: 1;
            color: #1572e8;
            background: rgba(21, 114, 232, .15)
        }

        .selectgroup-input:focus+.selectgroup-button {
            border-color: #1572e8;
            z-index: 2;
            color: #1572e8;
            box-shadow: 0 0 0 2px rgba(21, 114, 232, .25)
        }

        .selectgroup-pills {
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: start;
            align-items: flex-start
        }

        .selectgroup-pills .selectgroup-item {
            margin-right: .5rem;
            -ms-flex-positive: 0;
            flex-grow: 0
        }

        .selectgroup-pills .selectgroup-button {
            border-radius: 50px !important
        }

        .selectgroup.selectgroup-primary .selectgroup-input:checked+.selectgroup-button {
            border-color: #1572e8;
            color: #1572e8;
            background: rgba(21, 114, 232, .15)
        }

        .selectgroup.selectgroup-primary .selectgroup-input:focus+.selectgroup-button {
            border-color: #1572e8;
            color: #1572e8;
            box-shadow: 0 0 0 2px rgba(21, 114, 232, .25)
        }

        .selectgroup.selectgroup-secondary .selectgroup-input:checked+.selectgroup-button {
            border-color: #6861ce;
            color: #6861ce;
            background: rgba(104, 97, 206, .15)
        }

        .selectgroup.selectgroup-secondary .selectgroup-input:focus+.selectgroup-button {
            border-color: #6861ce;
            color: #6861ce;
            box-shadow: 0 0 0 2px rgba(104, 97, 206, .25)
        }

        .selectgroup.selectgroup-info .selectgroup-input:checked+.selectgroup-button {
            border-color: #48abf7;
            color: #48abf7;
            background: rgba(72, 171, 247, .15)
        }

        .selectgroup.selectgroup-info .selectgroup-input:focus+.selectgroup-button {
            border-color: #48abf7;
            color: #48abf7;
            box-shadow: 0 0 0 2px rgba(72, 171, 247, .25)
        }

        .selectgroup.selectgroup-success .selectgroup-input:checked+.selectgroup-button {
            border-color: #31ce36;
            color: #31ce36;
            background: rgba(49, 206, 54, .15)
        }

        .selectgroup.selectgroup-success .selectgroup-input:focus+.selectgroup-button {
            border-color: #31ce36;
            color: #31ce36;
            box-shadow: 0 0 0 2px rgba(49, 206, 54, .25)
        }

        .selectgroup.selectgroup-warning .selectgroup-input:checked+.selectgroup-button {
            border-color: #ffad46;
            color: #ffad46;
            background: rgba(255, 173, 70, .15)
        }

        .selectgroup.selectgroup-warning .selectgroup-input:focus+.selectgroup-button {
            border-color: #ffad46;
            color: #ffad46;
            box-shadow: 0 0 0 2px rgba(255, 173, 70, .25)
        }

        .selectgroup.selectgroup-danger .selectgroup-input:checked+.selectgroup-button {
            border-color: #f25961;
            color: #f25961;
            background: rgba(242, 89, 97, .15)
        }

        .selectgroup.selectgroup-danger .selectgroup-input:focus+.selectgroup-button {
            border-color: #f25961;
            color: #f25961;
            box-shadow: 0 0 0 2px rgba(242, 89, 97, .25)
        }

        .colorinput {
            margin: 0;
            position: relative;
            cursor: pointer;
        }

        .colorinput-input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .colorinput-color {
            display: inline-block;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 3px;
            border: 1px solid rgba(0, 40, 100, 0.12);
            color: #fff;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .colorinput-color:before {
            content: '';
            opacity: 0;
            position: absolute;
            color: #f25961;
            top: .25rem;
            left: .25rem;
            height: 1.25rem;
            width: 1.25rem;
            transition: .3s opacity;
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E") no-repeat center center/50% 50%;
        }

        .colorinput-input:checked~.colorinput-color:before {
            opacity: 1;
        }

        .colorinput-input:focus~.colorinput-color {
            border-color: #467fcf;
            box-shadow: 0 0 0 2px rgba(70, 127, 207, 0.25);
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

    </style>
@endsection
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpLabel">Cara Mengetahui kode video youtube</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{ asset('/img/yt how.png') }}" alt="" srcset="">
                    </div>
                    <div class="text-left my-2">
                        Pada gambar diatas kode video / id video nya ada lah <b>Z5z1okXtQSA</b>.
                        Untuk mengetahui kode /id video youtube silahkan buka video lewat browser.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <div class="jumbotron">
            <div class="container text-center">
                <div class="loader">
                    <div class="spinner-border mt-5" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
                        <h4 class="alert-heading">Terjadi beberapa Kesalahan : </h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                @endif

                <div class="d-none form-create-videos text-left">
                    <form action="{{ route('videos.update', $video->slug) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group text-left">
                                    <label for="title">Judul</label>
                                    <input required autocomplete="off" value="{{ old('title') ?? $video->title }}"
                                        name="title" type="text" class="form-control" id="title"
                                        placeholder="Judul Video sobat">
                                    @error('title')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group text-left">
                                    <textarea class="editor" name="description" id="" cols="30"
                                        rows="10">{{ old('description') ?? $video->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 ">
                                <div class="form-group my-3">
                                    <label class="form-label">Kode Video Youtube</label>
                                    <input name="code_video" value="{{ old('code_video') ?? $video->code_video }}"
                                        autocomplete="off" placeholder="Z5z1okXtQSA" type="text"
                                        class="form-control col-lg-12" style="width: 100%">
                                    <small>Contoh kode video youtube <a href="#" data-toggle="modal"
                                            data-target="#help">Klik disini</a></small>
                                </div>
                                {{-- add img --}}
                                <div class="custom-file">
                                    <input type="file" name="img" class="custom-file-input" id="img">
                                    <label class="custom-file-label" for="img">Pilih Gambar</label>
                                </div>
                                <div class="form-group my-3">
                                    <label class="form-label">Tags</label>
                                    <input name="tags" type="text" class="form-control col-lg-12" style="width: 100%"
                                        data-role="tagsinput">
                                    <small>Tag Video Saat Ini |
                                        @foreach ($video->tags as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                    </small>
                                </div>
                                <div class="bg-light preview card text-center mb-2">
                                    <img src="/storage/{{ $video->img }}" class="img-thumbnail" alt="img video">
                                </div>


                            </div>
                        </div>
                </div>
                <hr class=" text-left">
                <div class="btn-footer row justify-content-start">
                    <a href="/dashboard/videos" class="btn btn-light col-lg-3 mx-2 my-2">Batal</a>
                    <button type="submit" class="btn btn-success col-lg-3 mx-2 my-2">simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('script')
    <script src="/js/tagsinput.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/ckeditor.js"></script>

    <script>
        $(document).ready(function() {

            $("#kategori").select2({
                tags: true,
                placeholder: 'Pilih Kategori'
            });



            setTimeout(function() {
                $('.msg').hide()
            }, 5000);
            setTimeout(function() {
                $('.form-create-videos').removeClass('d-none');
                // $('.loader').addClass('d-none')
                $('.loader').remove();
            }, 1000);
            ClassicEditor
                .create(document.querySelector('.editor'), {

                    toolbar: {
                        items: [
                            'bold',
                            'underline',
                            'italic',
                            'link',
                            '|',
                            'numberedList',
                            'bulletedList',
                            'codeBlock',
                            '|',
                            'undo',
                            'redo'
                        ]
                    },
                    language: 'en',
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'imageStyle:full',
                            'imageStyle:side'
                        ]
                    },
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    },
                    licenseKey: '',

                })
                .then(editor => {
                    window.editor = editor;




                })
                .catch(error => {
                    console.error('Oops, something gone wrong!');
                    console.error(
                        'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:'
                    );
                    console.warn('Build id: wogjq72hstag-ysvcu7d7b0xg');
                    console.error(error);
                });

        })
    </script>
@endsection
