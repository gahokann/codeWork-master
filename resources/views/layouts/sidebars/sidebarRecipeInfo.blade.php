<aside class="sidebar">
    <h1 class="sidebar__title">CodeWork</h1>
    <p class="sidebar__subtitle">Рецепт</p>
    <nav class="sidebar__nav recipeinfo">
        <a href="{{ route('catalog.show') }}" class="sidebar__nav__link catalog__btn active" id="catalog_btn">
            @include('layouts.icon.catalog')
            Категории
        </a>
        @if(Auth::check())
        <a href="{{ route('profile.myRecipe', ['id' => Auth::user()->id]) }}" class="sidebar__nav__link catalog__btn">
            @include('layouts.icon.account')
            Личный кабинет
        </a>
        @endif

        @if(Auth::check() && Auth::user()->isAdmin())
        <a href='{{ route('admin.changeRecipe', ['id' => $recipe->id]) }}' class="sidebar__nav__link catalog__btn">
            @include('layouts.icon.gear')
            Редактировать рецепт
        </a>
        @endif
        @if (session('status'))
                <div class="alert alert-success alert-info" role="alert">
                    {{ session('status') }}
                </div>
            @endif
    </nav>
    <div class="recipeinfo__text">
        <h3 class="recipeinfo__title">Информация</h3>
        <p class="recipeinfo__info"><span class="bold">Категория</span>: {{ $recipe->category->name }}</p>
        <p class="recipeinfo__info"><span class="bold">Язык программирования</span>: {{ $recipe->language->full_name }}</p>
        <p class="recipeinfo__info"><span class="bold">Теги</span>:
            @foreach ($recipe->tags as $tag)
                <span class="badge bg-danger">{{ ($tag->name) }}</span>
            @endforeach
        </p>
        <time class="recipeinfo__info date" datetime="{{ $recipe->created_at }}"><span class="bold">Дата создания</span> {{ $recipe->created_at }}</time>
        <p class="recipeinfo__info"><span class="bold">Автор</span>: <a href="{{ route('profile.user', ['id' => $recipe->user->id]) }}"><span class="badge rounded-pill text-bg-primary">{{ $recipe->user->login }}</span></a></p>
        @if (Auth::check())
            @if(Auth::user()->isAdmin())
            <p class="recipeinfo__info"><span class="bold">Дата изменения</span>:  {{ $recipe->updated_at }}</p>
             @endif
        @endif


        <p class="recipeinfo__info"><span class="bold">Рейтинг</span>: {{ $recipe->rating }}</p>

        @if (Auth::check())
        <div style="margin-top: 10px; display:flex; column-gap: 10px">
            <form action="{{ route('catalog.evaluationRecipe', ['id' => $recipe->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="value" value="1">
                <button type="submit" class="btn btn-outline-success btn-sm"> @include('layouts.icon.like') </button>
            </form>
            <form action="{{ route('catalog.evaluationRecipe', ['id' => $recipe->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="value" value="0">
                <button type="submit" class="btn btn-outline-danger btn-sm">@include('layouts.icon.dislike')</button>
            </form>
        </div>
        @endif
    </div>

</aside>
