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
           .selectgroup{display:-ms-inline-flexbox;display:inline-flex}.selectgroup-item{-ms-flex-positive:1;flex-grow:1;position:relative;font-weight:400!important}.selectgroup-item+.selectgroup-item{margin-left:-1px}.selectgroup-item:not(:first-child) .selectgroup-button{border-top-left-radius:0;border-bottom-left-radius:0}.selectgroup-item:not(:last-child) .selectgroup-button{border-top-right-radius:0;border-bottom-right-radius:0}.selectgroup-input{opacity:0;position:absolute;z-index:-1;top:0;left:0}.selectgroup-button{display:block;border:1px solid rgba(0,40,100,.12);text-align:center;padding:.375rem 1rem;position:relative;cursor:pointer;border-radius:3px;color:#9aa0ac;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;font-size:14px;line-height:1.5rem;min-width:2.375rem}.selectgroup-button-icon{padding-left:.5rem;padding-right:.5rem;font-size:1rem}.selectgroup-input:checked+.selectgroup-button{border-color:#1572e8;z-index:1;color:#1572e8;background:rgba(21,114,232,.15)}.selectgroup-input:focus+.selectgroup-button{border-color:#1572e8;z-index:2;color:#1572e8;box-shadow:0 0 0 2px rgba(21,114,232,.25)}.selectgroup-pills{-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-align:start;align-items:flex-start}.selectgroup-pills .selectgroup-item{margin-right:.5rem;-ms-flex-positive:0;flex-grow:0}.selectgroup-pills .selectgroup-button{border-radius:50px!important}.selectgroup.selectgroup-primary .selectgroup-input:checked+.selectgroup-button{border-color:#1572e8;color:#1572e8;background:rgba(21,114,232,.15)}.selectgroup.selectgroup-primary .selectgroup-input:focus+.selectgroup-button{border-color:#1572e8;color:#1572e8;box-shadow:0 0 0 2px rgba(21,114,232,.25)}.selectgroup.selectgroup-secondary .selectgroup-input:checked+.selectgroup-button{border-color:#6861ce;color:#6861ce;background:rgba(104,97,206,.15)}.selectgroup.selectgroup-secondary .selectgroup-input:focus+.selectgroup-button{border-color:#6861ce;color:#6861ce;box-shadow:0 0 0 2px rgba(104,97,206,.25)}.selectgroup.selectgroup-info .selectgroup-input:checked+.selectgroup-button{border-color:#48abf7;color:#48abf7;background:rgba(72,171,247,.15)}.selectgroup.selectgroup-info .selectgroup-input:focus+.selectgroup-button{border-color:#48abf7;color:#48abf7;box-shadow:0 0 0 2px rgba(72,171,247,.25)}.selectgroup.selectgroup-success .selectgroup-input:checked+.selectgroup-button{border-color:#31ce36;color:#31ce36;background:rgba(49,206,54,.15)}.selectgroup.selectgroup-success .selectgroup-input:focus+.selectgroup-button{border-color:#31ce36;color:#31ce36;box-shadow:0 0 0 2px rgba(49,206,54,.25)}.selectgroup.selectgroup-warning .selectgroup-input:checked+.selectgroup-button{border-color:#ffad46;color:#ffad46;background:rgba(255,173,70,.15)}.selectgroup.selectgroup-warning .selectgroup-input:focus+.selectgroup-button{border-color:#ffad46;color:#ffad46;box-shadow:0 0 0 2px rgba(255,173,70,.25)}.selectgroup.selectgroup-danger .selectgroup-input:checked+.selectgroup-button{border-color:#f25961;color:#f25961;background:rgba(242,89,97,.15)}.selectgroup.selectgroup-danger .selectgroup-input:focus+.selectgroup-button{border-color:#f25961;color:#f25961;box-shadow:0 0 0 2px rgba(242,89,97,.25)}
.colorinput {
  margin: 0;
  position: relative;
  cursor: pointer; }

.colorinput-input {
  position: absolute;
  z-index: -1;
  opacity: 0; }

.colorinput-color {
  display: inline-block;
  width: 1.75rem;
  height: 1.75rem;
  border-radius: 3px;
  border: 1px solid rgba(0, 40, 100, 0.12);
  color: #fff;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
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
    background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E") no-repeat center center/50% 50%; }

.colorinput-input:checked ~ .colorinput-color:before {
  opacity: 1; }
.colorinput-input:focus ~ .colorinput-color {
  border-color: #467fcf;
  box-shadow: 0 0 0 2px rgba(70, 127, 207, 0.25); }

    </style>
@endsection
@section('content')
{!! session('msg') !!}

<div class="content">
    <div class="row my-4 mb-5 mx-0 justify-content-center">
       @include('dashboard.nav')
        <div class="col-lg-9 bg-light rounded py-4 px-3">
            <h3>Edit kategori</h3>
            <div class="body mt-4 p-3">
                <form method="POST" action="{{ route('category.update',$category->id) }}" >
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="categori">Kategori</label>
                            <input autofocus name="name" value="{{ $category->name }}" id="categori" autocomplete="off" autofocus type="text" class="form-control" placeholder="Kategori">
                            @error('name')
                                <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>
                            
                        <div class="form-group">
                            <label class="form-label">Background</label>
                            <div class="row justify-content-center text-center gutters-xs">
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'dark'?'checked':'' }} value="dark" class="colorinput-input">
                                        <span class="colorinput-color bg-dark"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'primary'?'checked':'' }} value="primary" class="colorinput-input">
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'secondary'?'checked':'' }} value="secondary" class="colorinput-input">
                                        <span class="colorinput-color bg-secondary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'info'?'checked':'' }} value="info" class="colorinput-input">
                                        <span class="colorinput-color bg-info"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'success'?'checked':'' }} value="success" class="colorinput-input">
                                        <span class="colorinput-color bg-success"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'danger'?'checked':'' }} value="danger" class="colorinput-input">
                                        <span class="colorinput-color bg-danger"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="class" required type="radio" {{ $category->class == 'warning'?'checked':'' }} value="warning" class="colorinput-input">
                                        <span class="colorinput-color bg-warning"></span>
                                    </label>
                                </div>
                            </div>
                                                                
                        </div>
                        <div class="btn-submit mt-5 text-center">
                            <a class="btn btn-secondary col-lg-5 my-2" href="{{ route('category.index') }}">Batal</a>
                            <button class="btn btn-success col-lg-5  my-2" type="submit">Submit</button>
                        </div>
                </form>
                    
                
            </div>
        </div>

    </div>
</div>
@endsection