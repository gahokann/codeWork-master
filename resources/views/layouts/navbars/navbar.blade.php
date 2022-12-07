<nav class="navbar">
    @if(!Auth::check())
    <div>
            <p class="navbar__title">Вы не авторизованы</p>
            <a href="{{ route('login') }}" class="navbar__exit catalog">Авторизоваться</a>
            {{-- <p class="navbar__title">{{ $user->login }}</p>
            <p class="navbar__subtitles">{{ $user->email }}</p>
            <a href="{{ route('logout') }}" class="navbar__exit">Выйти</a> --}}
    </div>
    @else
    <img src="{{ asset('img/imageUser/'. $user->photoPath) }}" class="navbar__logo" alt="">

    <div>
        <p class="navbar__title">{{ Auth::user()->login }}</p>
        <p class="navbar__subtitles">{{ Auth::user()->email }}</p>
        <a href="{{ route('logout') }}" class="navbar__exit">Выйти</a>
    </div>
    @endif
</nav>
