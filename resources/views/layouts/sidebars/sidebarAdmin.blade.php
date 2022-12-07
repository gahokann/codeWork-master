<aside class="sidebar">
    <h1 class="sidebar__title">CodeWork</h1>
    <p class="sidebar__subtitle">Панель Администратора</p>
    <nav class="sidebar__nav">
        <a href="{{ route('admin.index', ['id' => $user->id]) }}" class="sidebar__nav__link @yield('activeMain')">
            @include('layouts.icon.home')
            <p>Главная</p>
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
        <a href="{{ route('profile.user', ['id' => $user->id]) }}" class="sidebar__nav__link">
            @include('layouts.icon.user')
            <p>Личный кабинет</p>
        </a>
    </nav>
</aside>
