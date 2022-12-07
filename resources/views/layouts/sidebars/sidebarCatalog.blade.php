<aside class="sidebar">
    <h1 class="sidebar__title">CodeWork</h1>
    <p class="sidebar__subtitle">Каталог</p>
    <nav class="sidebar__nav">
        <a href="{{ route('home') }}" class="sidebar__nav__link">
            @include('layouts.icon.home')
            <p>Главная</p>
        </a>
        @if(Auth::check())
        <a href='{{ route('profile.myRecipe', ['id' => Auth::user()->id]) }}' class="sidebar__nav__link catalog__btn">
            @include('layouts.icon.account')
            Личный кабинет
        </a>
        @endif
        <a href="#" class="sidebar__nav__link catalog__btn dropdown-toggle" id="catalog_btn" data-bs-toggle="dropdown" aria-expanded="false">
            @include('layouts.icon.catalog')
            Категории
        </a>
        <ul class="dropdown-menu">
            @foreach ($array['category'] as $val)
                <li><a class="dropdown-item" href="{{ route('catalog.showCategory', ['id' => $val->id]) }}">{{ $val->name }}</a></li>
            @endforeach

            <li><a class="dropdown-item" href="{{ route('catalog.show') }}">Всё</a></li>
        </ul>
    </nav>
    <div class="sidebar__filter__catalog">
        <form action="{{ route('catalog.show') }}" method="GET" class="filter__catalog__form">
            <h3 class="filter__catalog__title">Языки программирования</h3>
            <div class="filter__overflow">
                @foreach ($array['language'] as $val)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$val->id}}" name="lang[]" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      {{ $val->full_name }}
                    </label>
                  </div>
                @endforeach
            </div>
            <h3 class="filter__catalog__title">Тэги</h3>
            <div class="filter__overflow">
                @foreach ($array['tag'] as $val)
                    <div class="form-check">
                        <input class="form-check-input" name="tag[]" type="checkbox" value="{{$val->id}}" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        {{ $val->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success" style="margin-top: 15px">Найти</button>
        </form>
    </div>
</aside>
