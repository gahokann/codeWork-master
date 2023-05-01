@extends('layouts.catalog')

@section('title')
    Catalog
@endsection

@section('content')
    <div class="content__catalog">
        <h1 class="content__catalog__title">Каталог</h1>
        <form action="{{ route('catalog.search') }}" method="GET" class="d-flex catalog__search" role="search">
            @csrf
            <div class="search__div">
                <input class="form-control me-2" style="padding-right: 40px" id="inputSearch" name="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn__search" type="submit">@include('layouts.icon.search')</button>
            </div>
            @error('search')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </form>
        <div class="d-flex" style="margin: 25px 25px 0 25px; gap: 15px; flex-wrap: wrap; max-width: 1200px;">
            @foreach ($array['category'] as $val)
                <a href="{{ route('catalog.showCategory', ['id' => $val->id]) }}"><span class="badge rounded-pill text-bg-warning badge-catalog {{ isset($category) ? $category->id == $val->id ? 'active' : '' : ""}}">{{ $val->name }}</span></a>
            @endforeach
        </div>
        <div class="catalog__items d-flex" style="flex-wrap: wrap; gap: 25px">
            @foreach ($recipes as $recipe)
                <div class="catalog__item__card {{ $recipe->rating < 0 ? 'low-rating' : '' }}">
                    <div class="item__card__info-one">
                        <div class="d-flex align-items-center" style="column-gap: 10px">
                            <a class="link__author" href="{{ route('catalog.showAuthor', ['id' => $recipe->author_id]) }}">
                                <img src="{{ asset('img/imageUser/'. $recipe->user->photoPath) }}" alt="" class="card__img">
                            </a>
                            <div>
                                <a href="{{ route('catalog.showAuthor', ['id' => $recipe->author_id]) }}" class="link__author"><h3 class="card__name">{{ $recipe->user->login }}</h3></a>
                                <p class="card__time">{{ date("d.m.Y, H:i", strtotime($recipe->created_at)) }}</p>
                            </div>
                        </div>
                        <span class="badge text-bg-warning color-language" id="{{ $recipe->language->id }}">{{ $recipe->language->full_name }}</span>
                    </div>
                    <div class="item__card__info-two">
                        <a href="{{ route('catalog.recipe', ['id'=>$recipe->id]) }}" class="link__author font-break"><h1 class="item__title text-break">{{ $recipe->title }}</h1></a>
                        <p class="text-break mt-4">{!! $recipe->description !!}</p>
                        <div class="d-flex justify-between flex-wrap mt-4" style="column-gap: 25px; row-gap: 15px">
                            @foreach ($recipe->tags as $tags)
                                <a class="link__tag__catalog" href="{{ route('catalog.showTag', ['tag' => $tags->id]) }}"><span id="{{ $tags->id }}" class="badge badge__tags">{{ $tags->name }}</span></a>
                            @endforeach
                        </div>
                        <div class="item__card__rating d-flex align-items-center mt-3" style="column-gap: 10px">
                            @include("layouts.icon.star")
                            <p class="fs-5">{{ $recipe->rating }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- @foreach ($recipes as $recipe)
                <div class="catalog__item">
                    <div class="col-md-6 mt-1">
                        <h5>{{ $recipe->title }}</h5>
                        <div class=" catalog__item__tags  d-flex flex-row">
                            @foreach ($recipe->tags as $tags)
                                <a class="link__tag__catalog" href="{{ route('catalog.showTag', ['tag' => $tags->id]) }}"><span class="badge text-bg-danger">{{ $tags->name }}</span></a>
                            @endforeach
                        </div>
                        <p class="catalog__item__text one"><span class="bold">Категория:</span> {{ $recipe->category->name }}</p>
                        <p class="catalog__item__text one"><span class="bold">Язык программирования:</span> {{ $recipe->language->full_name }}</p>
                        <p class="catalog__item__text"><span class="bold">Рейтинг</span>: {{ $recipe->rating }}</p>
                        <p class="catalog__item__text"><span class="bold">Автор</span>: <a href="{{ route('catalog.showAuthor', ['id' => $recipe->user->id]) }}"><span class="badge rounded-pill text-bg-primary">{{ $recipe->user->login }}</span></a></p>

                    </div>
                    <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <p class="text-break"><span class="bold">Описание:</span> {{ $recipe->description }}</p>
                        <time class="catalog__item__text date" datetime="2019-04-29 19:00"><span class="bold">Дата создания</span> {{ $recipe->created_at }}</time><br>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('catalog.recipe', ['id'=>$recipe->id]) }}" class="link_catalog btn btn-outline-success">Открыть</a>
                        </div>
                    </div>
                </div>
            @endforeach --}}
        </div>

    </div>
    <script>
        let parent = document.querySelectorAll('.badge__tags');
        let language = document.querySelectorAll('.color-language');

        let colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        let customColors = ['green', 'blue', 'red', 'yellow', 'info', 'black'];

        for (let elem of parent) {
            let color = colors[elem.id % colors.length];
            elem.classList.add('text-bg-' + color);
            console.log(color);
        }

        for (let elem of language) {
            let color = customColors[elem.id % customColors.length];
            elem.classList.add(color);
            console.log(color);
        }
    </script>
@endsection
