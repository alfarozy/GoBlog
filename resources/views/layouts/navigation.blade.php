<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand d-flex" href="/">
        <img class="d-inline-block align-top" src="{{ url('img/logo2.png') }}" height="45" alt="" srcset="">
        {{-- <span class="h3 mt-1 ml-2">Blog</span> --}}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item{{ request()->is('/') ? ' active' : '' }}">
                <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item{{ request()->is('video') ? ' active' : '' }}">
                <a class="nav-link" href="/video">Video</a>
            </li>
            <li class="nav-item{{ request()->is('blog') ? ' active' : '' }}">
                <a class="nav-link" href="/blog">Blog</a>
            </li>
            <li class="nav-item{{ request()->is('about') ? ' active' : '' }}">
                <a class="nav-link" href="/about">about</a>
            </li>
            <li class="nav-item{{ request()->is('contact') ? ' active' : '' }}">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="/dashboard/articles">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('videos.create') }}">New Video</a>
                        <a class="dropdown-item" href="/article/create">New Post</a>
                        <a class="dropdown-item" href="{{ route('profile') }}">Profil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

</nav>
