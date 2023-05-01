@extends('layouts.catalog')

@section('link')<link rel="stylesheet" href="app/styles//base16/synth-midnight-terminal-dark.min.css"> @endsection
@section('title')
    recipeInfo
@endsection

@section('content')
    <div class="content__recipe__items">
        <form action="{{ route('catalog.search') }}" style="margin-left: 0;" method="GET" class="d-flex catalog__search" role="search">
            @csrf
            <div class="search__div">
                <input class="form-control me-2" style="padding-right: 40px" id="inputSearch" name="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn__search" type="submit">@include('layouts.icon.search')</button>
            </div>
            @error('search')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </form>
        @if($recipe->rating < 0)
        <div class="alert alert-danger mt-4" role="alert">
            Внимание! Рецепт может быть неактуальным!
          </div>
        @endif
        <div class="recipe__item">
            <div class="item__card__info-one">
                <div class="d-flex align-items-center" style="column-gap: 10px">
                    <a href="{{ route('profile.user', ['id' => $recipe->author_id]) }}">
                        <img src="{{ asset('img/imageUser/'. $recipe->user->photoPath) }}" alt="" class="card__img">
                    </a>
                    <div>
                        <a href="{{ route('profile.user', ['id' => $recipe->author_id]) }}">
                            <h3 class="card__name">{{ $recipe->user->login }}</h3>
                        </a>
                        <p class="card__time">{{ date("d.m.Y, H:i", strtotime($recipe->created_at)) }}</p>
                    </div>
                </div>
                <div>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('admin.changeRecipe', ['id' => $recipe->id]) }}" class="btn">@include('layouts.icon.change')</a>
                    @endif
                        <span class="badge badge-code text-bg-warning color-language" id="{{ $recipe->language_id }}">{{ $recipe->language->full_name }}</span>
                </div>

            </div>
            <div class="item__recipe mt-4">
                <h4 class="item__recipe__title">{{ $recipe->title }}</h4>
                <div class="d-flex justify-between flex-wrap mt-4" id="tags" style="column-gap: 10px; row-gap: 15px">
                    @foreach ($recipe->tags as $tags)
                        <a class="link__tag__catalog" href="{{ route('catalog.showTag', ['tag' => $tags->id]) }}"><span id="{{ $tags->id }}" class="badge badge__tags rounded-pill ">{{ $tags->name }}</span></a>
                    @endforeach
                </div>
                <p class="font-break mt-4">{!! $recipe->description !!}</p>
                <pre>
                    <code class="js" style="border-radius: 12px">
{{ $recipe->code }}
                    </code>
                </pre>
                <div class="d-flex align-items-center mt-3" style="justify-content: space-between">
                    <div class="d-flex align-items-center" style="column-gap: 10px">
                        @include("layouts.icon.star")
                        <p class="fs-5">{{ $recipe->rating }}</p>
                    </div>
                    @if (Auth::check())
                    <div style="margin-top: 10px; display:flex; column-gap: 10px">
                        <form action="{{ route('catalog.evaluationRecipe', ['id' => $recipe->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="value" value="1">
                            <button type="submit" class="btn"> @include('layouts.icon.like') </button>
                        </form>
                        <form action="{{ route('catalog.evaluationRecipe', ['id' => $recipe->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="value" value="0">
                            <button type="submit" class="btn">@include('layouts.icon.dislike')</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="content__recipe__item comment mt-5">
                @if(Auth::check())
                <div class="card-footer card__pos py-3 border-0">
                    <form action="{{ route('catalog.createComment', ['id' => $recipe->id]) }}" method="POST">
                        @csrf
                        <div class="d-flex flex-start w-100">
                            <img class="rounded-circle shadow-1-strong me-3 navbar__logo" src="{{ asset('img/imageUser/'. Auth::user()->photoPath) }}" alt="avatar" width="40" height="40" />
                            <div class="form-outline w-100 textarea-block__comment">
                                <textarea name="text" class="form-control comment__textarea" id="textAreaExample" placeholder="Введите коммантарий" rows="4" style="background: #fff;"></textarea>
                                @error('text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="block-comment">
                                    <button type="submit" class="btn btn-primary btn-comment">Ответить</button>
                                </div>
                            </div>

                        </div>
                        <div class="float-end mt-2 pt-1">
                        </div>

                    </form>
                </div>
                @endif
                @foreach ($array['comment'] as $val)
                <div class="card" style="margin-bottom: 15px">
                    <div class="card-body">
                        <div class="d-flex flex-start justify-content-between align-items-center">
                            <div style="align-items: center" class="d-flex aling-items-center">
                                <img class="rounded-circle shadow-1-strong me-3 navbar__logo" src="{{ asset('img/imageUser/'. $val->user[0]->photoPath) }}" alt="avatar" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">{{ $val->user[0]->login }}</h6>
                                    <p class="text-muted small mb-0"> {{ date("d.m.Y, H:i", strtotime($val->created_at))}}</p>
                                </div>
                            </div>
                            <div>
                                @if (Auth::check())
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.destroyComment', ['id' => $val->id]) }}" class="btn btn-delete">@include('layouts.icon.trash')</a>
                                    @endif
                                @endif
                            </div>

                        </div>
                            <p class="mt-3 pb-2"> {{ $val->text }} </p>
                    </div>
                </div>
                @endforeach

            </div>
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
