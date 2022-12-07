<aside class="sidebar">
    <h1 class="sidebar__title">CodeWork</h1>
    <p class="sidebar__subtitle">Личный кабинет</p>
    <nav class="sidebar__nav">
        <a href="{{ route('profile.user', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeMain')">
            @include('layouts.icon.home')
            <p>Главная</p></a>
        <a href="{{ route('profile.settings', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeSettings')">
            @include('layouts.icon.settings')
            Настройки</a>
            <a href="{{ route('profile.myRecipe', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeMyRecipe')">
            @include('layouts.icon.list')
            Мои рецепты</a>
        <a href="{{ route('catalog.show') }}" class="sidebar__nav__link catalog__btn " id="catalog_btn">
            @include('layouts.icon.catalog')
            Каталог
        </a>
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.index', ['id' => $user->id]) }}" class="sidebar__nav__link catalog__btn @yield('activePanelAdmin')" id="catalog_btn">
            @include('layouts.icon.admin')
            Панель администратора
        </a>
        @endif
        @if(Auth::user()->isAdmin())
            @if (session('status'))
                <div class="alert alert-success alert-info" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        @endif

    </nav>
</aside>
