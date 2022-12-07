@extends('layouts.admin')

@section('title') AdminPage @endsection
@section('activeRecipe') active @endsection

@section('content')

<div class="content__recipe">
    <div class="recipe__start">
        <h3 class="recipe__title">Рецепты</h3>
    </div>
    <form class="d-flex recipe__search" action="{{ route('admin.searchRecipe', ['id' => $user->id]) }}" role="search">
        <input class="form-control me-2" name="search" id="inputSearch" type="search" placeholder="Поиск" aria-label="Поиск">
        <button class="btn btn-outline-success" type="submit">Поиск</button>
    </form>
        @if (session('status'))
        <div class="alert alert-success alert-myrecipe" role="alert">
            {{ session('status') }}
        </div>
        @endif
    <!-- <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Рейтинг</th>
            <th scope="col">Язык программирования</th>
            <th scope="col">Тэги</th>
            <th scope="col">Категория</th>
            <th scope="col">Дата создания</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Математические функция</td>
            <td>1</td>
            <td>JavaScript</td>
            <td>
                <span class="badge bg-danger">Функция</span>
                <span class="badge bg-danger">Круто</span>
            </td>
            <td>Математические функции</td>
            <td><time datetime="2019-04-29 19:00">2019-04-29</time></td>
            <td><a href="#" class="btn btn-outline-primary">Открыть</a></td>
          </tr>
        </tbody>
      </table> -->

      <div class="table-responsive">
        <table class="table align-middle" id="table">
          <thead>
            <tr>
                <th>#</th>
                <th>Заголовок</th>
                <th>Автор</th>
                <th>Рейтинг</th>
                <th>Язык программирования</th>
                <th>Тэги</th>
                <th>Категория</th>
                <th>Дата создания</th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($recipes as $val)
            <tr>
                <th scope="row">{{ $val->id }}</th>
                <td>{{ $val->title }}</td>
                <td>{{ $val->user->login }}</td>
                <td>{{ $val->rating }}</td>
                <td>{{ $val->language->full_name }}</td>
                <td>
                    @foreach ($val->tags as $tag)
                        <span class="badge bg-danger">{{ ($tag->name) }}</span>
                    @endforeach
                </td>
                <td>{{ $val->category->name }}</td>
                <td><time datetime="{{ $val->created_at }}">{{ $val->created_at }}</time></td>
                <td><a href="{{ route('catalog.recipe', ['id'=>$val->id]) }}" class="btn btn-outline-primary">Открыть</a>
                    <a href="{{ route('admin.destroy', ['id' => $val->id]) }}" class="btn btn-outline-danger btn-open">Удалить</a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</div>
@endsection
