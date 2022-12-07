@extends('layouts.catalog')

@section('title')
    Catalog
@endsection

@section('content')
    <div class="content__catalog">
        <form action="{{ route('catalog.search') }}" method="GET" class="d-flex catalog__search" role="search">
            @csrf
            <input class="form-control me-2" id="inputSearch" name="search" type="search" placeholder="Поиск" aria-label="Поиск">
            @error('search')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <button class="btn btn-outline-success" type="submit">Поиск</button>
        </form>
        <div class="catalog__items">
            @foreach ($recipes as $recipe)
            <div class="card {{ $recipe->rating < 0 ? 'card__rating__low' : "" }}" style="width: 22rem;">
                {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                <div class="card-body">
                    <p style="font-size: 14px; color: rgba(0, 0, 0, 0.5)" class="mb-2">{{ date("d-m-Y H:i:s", strtotime($recipe->created_at)); }}</p>
                  <h5 class="card-title mb-2">{{ $recipe->title }}</h5>
                  <p class="card-text mb-2">{{ mb_strimwidth($recipe->description, 0, 25, '...'); }}</p>
                  <p class="card-text mb-2"><span class="fw-bold">Язык программирования: {{ $recipe->language->full_name }}</span></p>
                  <p class="mb-2"><span class="fw-bold">Рейтинг:</span> {{ $recipe->rating }}</p>
                  <p class="mb-2"><span class="fw-bold">Автор</span>: <a href="{{ route('catalog.showAuthor', ['id' => $recipe->user->id]) }}"><span class="badge text-bg-primary">{{ $recipe->user->login }}</span></a></p>
                  <div class="">
                    @foreach ($recipe->tags as $tags)
                        <a class="link__tag__catalog" href="{{ route('catalog.showTag', ['tag' => $tags->id]) }}"><span class="badge text-bg-danger">{{ $tags->name }}</span></a>
                    @endforeach
                  </div>
                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('catalog.recipe', ['id'=>$recipe->id]) }}" class="link_catalog btn btn-success">Открыть</a>
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
                        <p class="text-break"><span class="bold">Описание</span> {{ $recipe->description }}</p>
                        <time class="catalog__item__text date" datetime="2019-04-29 19:00"><span class="bold">Дата создания</span> {{ $recipe->created_at }}</time><br>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('catalog.recipe', ['id'=>$recipe->id]) }}" class="link_catalog btn btn-outline-success">Открыть</a>
                        </div>
                    </div>
                </div>
            @endforeach --}}
            {{-- <div class="catalog__item">
                <div class="col-md-6 mt-1">
                    <h5>{{ $recipes->title }}</h5>
                    <div class=" catalog__item__tags  d-flex flex-row">
                        <span class="badge text-bg-danger">JS</span>
                        <span class="badge text-bg-danger">Danger</span>
                        <span class="badge text-bg-danger">Danger</span>
                        <span class="badge text-bg-danger">Danger</span>
                    </div>
                    <p class="catalog__item__text one"><span class="bold">Категория:</span> Базы данных</p>
                    <p class="catalog__item__text one"><span class="bold">Язык программирования:</span> PHP</p>
                    <p class="catalog__item__text"><span class="bold">Рейтинг</span> 5</p>
                    <p class="catalog__item__text"><span class="bold">Автор</span> <span class="badge rounded-pill text-bg-primary">Сергей</span>

                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <p><span class="bold">Описание</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum modi eaque voluptatum nesciunt! Placeat iste nam voluptatem, tempora quibusdam dolorem quo perspiciatis quis enim tenetur. lorem50</p>
                    <time class="catalog__item__text date" datetime="2019-04-29 19:00"><span class="bold">Дата создания</span> 2019-04-29</time><br>
                    <div class="d-flex justify-content-end">
                        <a href="" class="link_catalog btn btn-outline-success">Открыть</a>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
@endsection
