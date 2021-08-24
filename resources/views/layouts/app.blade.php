<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <style>
        .img{
            height:230px;object-fit:cover;object-position:center;
        }
        a:hover{
            text-decoration: none;
        }
    </style>
    @yield('style')
</head>
<body>
  
@include('layouts.navigation')

@yield('content')
   

<footer class="bg-info sticky-bottom mt-5" >
    <div class="container text-center ">

        <div class="row  ">
        <div class="col-lg-12">
            <p class="text-white mt-3" href="#">2021 &copy; Hak Cipta Dilindungi Superman & Liga Keadilan | Dev by Me    
                <b><a class="text-light" href="https://alfarozy.id">Alfarozy.id</a></b></p>
        </div>
        </div>
    </div>
</footer>

<script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/all.min.js') }}"></script>
@yield('script')
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename)
    });
</script>
</body>
</html>