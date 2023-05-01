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
        <a href="{{ route('home') }}" class="sidebar__nav__link">
            @include('layouts.icon.home')
            <p>Домашняя страница</p>
        </a>
        @if(Auth::check())
            <a href="{{ route('profile.settings', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeSettings')">
                @include('layouts.icon.settings')
                Настройки
            </a>
            <a href="{{ route('profile.myRecipe', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeMyRecipe')">
            @include('layouts.icon.list')
            Мои рецепты
            </a>
        @endif
    </nav>
    <div class="sidebar__filter__catalog">
        <h2 class="fs-4 mb-3">Фильтры</h2>
        <form action="{{ route('catalog.show') }}" method="GET" class="filter__catalog__form">
            <h3 class="filter__catalog__title">Языки программирования</h3>
            <div class="filter__overflow">
                @foreach ($array['language'] as $val)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$val->id}}" {{  $filteredLang != Null ? gettype(array_search($val->id, $filteredLang)) == 'integer' ? 'checked': '' : "" }} name="lang[]" id="label{{ $val->id }}">
                    <label class="form-check-label" for="label{{ $val->id }}">
                      {{ $val->full_name }}
                    </label>
                  </div>
                @endforeach
            </div>
            <h3 class="filter__catalog__title">Тэги</h3>
            <div class="filter__overflow">
                @foreach ($array['tag'] as $val)
                    <div class="form-check">
                        <input class="form-check-input" name="tag[]" type="checkbox" {{  $filteredTag != Null ? gettype(array_search($val->id, $filteredTag)) == 'integer' ? 'checked': '' : "" }} value="{{$val->id}}" id="label2{{ $val->id }}">
                        <label class="form-check-label" for="label2{{ $val->id }}">
                        {{ $val->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success" style="margin-top: 15px">Найти</button>
        </form>
    </div>
    @if(Auth::check())
        @if(Auth::user()->isAdmin())
            <h2 class="fs-4 mb-3 title__admin">Администрирование</h2>
            <nav class="sidebar__nav admin">
                <div class="plashka">
                <a href="{{ route('admin.index', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeMain')">
                    @include('layouts.icon.admin')
                    <p>Панель администратора</p>
                </a>
                <a href="{{ route('admin.users', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeUser')">
                    @include('layouts.icon.user')
                    <p>Пользователи</p>
                </a>
                <a href="{{ route('admin.recipes', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeRecipe')">
                    @include('layouts.icon.recipe')
                    <p>Рецепты</p>
                </a>
                <a href="{{ route('admin.tags', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeTags')">
                    @include('layouts.icon.tags')
                    <p>Теги</p>
                </a>
                <a href="{{ route('admin.category', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeCategory')">
                    @include('layouts.icon.list')
                    <p>Категории</p>
                </a>
                </div>
            </nav>
        @endif
    @endif
</aside>
