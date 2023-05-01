<aside class="sidebar">
    <div class="sidebar__info__profile">
        <h1 class="sidebar__title">CodeWork</h1>
        <div class="info__profile">
            @if(Auth::check())
                <a href="{{ route('profile.user', ['id' => Auth::user()->id]) }}">
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
        @if(Auth::check())
        <a href="{{ route('profile.user', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeMain')">
            @include('layouts.icon.home')
            <p>Домашняя страница</p></a>
        <a href="{{ route('profile.settings', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeSettings')">
            @include('layouts.icon.settings')
            Настройки</a>
        <a href="{{ route('profile.myRecipe', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeMyRecipe')">
        @include('layouts.icon.list')
        Мои рецепты</a>
        @endif
        <a href="{{ route('catalog.show') }}" class="sidebar__nav__link catalog__btn " id="catalog_btn">
            @include('layouts.icon.catalog')
            Каталог
        </a>
        @if(Auth::check())
            @if(Auth::user()->isAdmin())
                @if (session('status'))
                    <div class="alert alert-success alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            @endif
            @if(Auth::user()->isAdmin())
            <h2 class="fs-4 mb-3 title__admin">Администрирование</h2>
            <div class="plashka">
                <a href="{{ route('admin.index', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeMainAdmin')">
                    @include('layouts.icon.admin')
                    <p>Панель администратора</p>
                </a>
                <a href="{{ route('admin.users', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeUserAdmin')">
                    @include('layouts.icon.user')
                    <p>Пользователи</p>
                </a>
                <a href="{{ route('admin.recipes', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeRecipeAdmin')">
                    @include('layouts.icon.recipe')
                    <p>Рецепты</p>
                </a>
                <a href="{{ route('admin.tags', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeTagsAdmin')">
                    @include('layouts.icon.tags')
                    <p>Теги</p>
                </a>
                <a href="{{ route('admin.category', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link @yield('activeCategoryAdmin')">
                    @include('layouts.icon.list')
                    <p>Категории</p>
                </a>
            </div>
            @endif
        @endif
    </nav>
</aside>
