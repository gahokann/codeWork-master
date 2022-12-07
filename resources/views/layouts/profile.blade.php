@include('layouts.default.head')
<body class="body-profile">
    <main class="main-profile">
        @if(Auth::check() && $user->id == Auth::user()->id)
            @include('layouts.sidebars.sidebar')
        @else
        <aside class="sidebar">
            <h1 class="sidebar__title">CodeWork</h1>
            <p class="sidebar__subtitle">Пользователь</p>
            <nav class="sidebar__nav">
                <a href="{{ route('home') }}" class="sidebar__nav__link active">
                    @include('layouts.icon.home')
                    <p>Главная</p></a>
            </nav>
        </aside>
        @endif
        <div class="content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>
    </main>
</body>
</html>
