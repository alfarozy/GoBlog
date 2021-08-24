<div class="col-lg-2">
    <ul class="list-group">
        <li class="list-group-item active">Dashboard</li>
        <li class="list-group-item"><a class="text-{{ request()->routeIs('article.*')?'info':'dark' }}" href="/dashboard/articles">Artikel saya</a></li>
        <li class="list-group-item py-1">
            <div class="submenu ml-3">
                <a class="text-{{ request()->routeIs('category.*')?'info':'dark' }}" href="{{ route('category.index') }}">Kategori </a>
            </div>
        </li>

        <li class="list-group-item"><a class="text-{{ request()->routeIs('videos.*')?'info':'dark' }}" href="/dashboard/videos">Video saya</a></li>
        <li class="list-group-item py-1">
            <div class="submenu ml-3">
                <a class="text-{{ request()->routeIs('playlists.*')?'info':'dark' }}" href="{{ route('playlists.index') }}">Video playlist</a>
            </div>
        </li>
        @if(Auth()->user()->hasRole('admin'))
        <li class="list-group-item {{ request()->is('users.*')?'active':'' }} "><a class="text-dark" href="/dashboard/users">Users</a></li>
        @endif
        <li class="list-group-item"><a class="text-dark" href="{{ route('profile') }}">Profil user</a></li>
    </ul>
</div>