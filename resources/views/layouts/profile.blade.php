@include('layouts.default.head')
<body class="body-profile">
    <main class="main-profile">
        @if(Auth::check())
            @include('layouts.sidebars.sidebar')
        @else
        <aside class="sidebar">
            <div class="sidebar__info__profile">
                <h1 class="sidebar__title">CodeWork</h1>
                <div class="info__profile">
                    @if(Auth::check())
                        <a href="{{ route('profile.user', ['id' => $user->id]) }}">
                            <img src="{{ asset('img/imageUser/'. $user->photoPath) }}" class="sidebar__profile__logo" alt="">
                        </a>
                        <a href="{{ route('logout') }}" class="sidebar__nav__exit">
                            @include('layouts.icon.exit')
                        </a>
                    @else
                    <a href="{{ route('login') }}">
                        <div class="sidebar__nav__exit login">
                            @include('layouts.icon.login')
                        </div>
                    </a>
                    @endif
                </div>
            </div>
            <nav class="sidebar__nav">
                <a href="{{ route('home') }}" class="sidebar__nav__link active">
                    @include('layouts.icon.home')
                    <p>Главная</p></a>
            </nav>
        </aside>
        @endif
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>
</html>
