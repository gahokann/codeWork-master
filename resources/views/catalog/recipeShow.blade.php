@extends('layouts.catalog')

@section('link')<link rel="stylesheet" href="app/styles//base16/synth-midnight-terminal-dark.min.css"> @endsection
@section('title')
    recipeInfo
@endsection

@section('content')
<div class="content">

    <div class="content__recipe__items">
        @if($recipe->rating < 0)
        <div class="alert alert-danger" style="" role="alert">
            Внимание! Данный рецепт может быть не актуальным! Будте внимательны при использовании данного рецепта!
        </div>
        @endif
        <div class="content__recipe__item">
            <h1 class="recipe__item__title">{{ $recipe->title }}</h1>
            <p class="recipe__item__desc">{{ $recipe->description }}</p>
            <pre>
                <code class="{{ $recipe->language->abbreviated }}">
{{ $recipe->code }}
                </code>
            </pre>
        </div>
        {{-- <div class="content__recipe__item">
            <div class="card shadow-0 border" style="padding: 0" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <div class="form-outline mb-4">
                        <input type="text" id="addANote" class="form-control" placeholder="Введите комментарий" />
                        <button class="btn btn-outline-success" style="margin-top: 15px">Ответить</button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p style="margin-bottom: 5px">Type your note, and hit enter to add it</p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp" alt="avatar" width="25" height="25" />
                                    <p class="small mb-0 ms-2">Martha</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="content__recipe__item comment">

            <div class="card">
                @foreach ($array['comment'] as $val)
                <div class="card-body">
                    <div class="d-flex flex-start justify-content-between align-items-center">
                        <div style="align-items: center" class="d-flex aling-items-center">
                            <img class="rounded-circle shadow-1-strong me-3 navbar__logo" src="{{ asset('img/imageUser/'. $val->user[0]->photoPath) }}" alt="avatar" />
                            <div>
                                <h6 class="fw-bold text-primary mb-1">{{ $val->user[0]->login }}</h6>
                                <p class="text-muted small mb-0"> {{ $val->created_at }} </p>
                            </div>
                        </div>
                        <div>
                            @if (Auth::check())
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.destroyComment', ['id' => $val->id]) }}" class="btn btn-danger btn-delete">Удалить</a>
                                @endif
                            @endif
                        </div>

                    </div>
                        <p class="mt-3 mb-4 pb-2"> {{ $val->text }} </p>
                </div>
                @endforeach
            </div>
            @if(Auth::check())
            <div class="card-footer card__pos py-3 border-0" style="background-color: #f8f9fa;">
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
        </div>
    </div>
</div>
@endsection
