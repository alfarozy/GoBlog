@extends('layouts/app')
@section('title','Dashboard | kategori Artikel & Video')
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
{{-- hapus modal --}}
{!! session('msg') !!}
<!-- Modal -->
<div class="modal fade" id="konfirm" tabindex="-1" role="dialog" aria-labelledby="konfirmLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="konfirmLabel">Hapus kategori ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- action form nya di ubah  --}}
      <form action="-" class="form-konfirm" method="post">
        @method('delete')
        @csrf
        <div class="row justify-content-end px-4 py-3">
          <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal" >Batal</button>
          <button type="button" class="btn btn-danger mx-2" type="submit" onclick="$('.form-konfirm').submit()" >Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- hapus modal --}}
<div class="content">
    <div class="row my-4 mx-0 justify-content-center">
       @include('dashboard.nav')
        <div class="col-lg-9 bg-light rounded py-4 px-3">
            <a href="{{ route('category.create') }}" class="btn btn-info float-right" >Tambah Kategori</a>
            <h3>Kategori </h3>
            <div class="body mt-4">
                <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col" >Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                          <th width=5% scope="row">{{ $loop->iteration }}</th>
                          
                          <td width=55%>
                              <a class="btn btn-sm btn-{{ $category->class }}" target="_blank" href="/article/{{ $category->slug }}">{{ $category->name }}</a> 
                        </td>
                        
                          <td><small class="text-muted"> <i class="fas fa-calendar-alt" ></i> {{ $category->created_at->format('d-m-Y') }}</small> </td>
                          <td><a class="btn btn-sm btn-info" href="{{ route('category.edit',$category->id) }}">Edit</a> <button class="btn btn-danger hapus btn-sm" data-action="{{ route('category.destroy',$category->id) }}" data-toggle="modal" data-target="#konfirm">Hapus</button></td>
                        </tr>
                        
                        @empty
                            <tr class="text-center" >
                              <th colspan="4" scope="row">Kategory anda masih kosong</th>
                            </tr>
                            
                        @endforelse
                    </tbody>
                  </table>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
    <script>
      $('.hapus').click(function () {
        var action = $(this).data('action')
        $('.form-konfirm').attr('action',action);
      })
      
      setTimeout(function () {
      $('.msg').hide()
      },5000);
    </script>
@endsection