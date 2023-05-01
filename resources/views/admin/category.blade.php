@extends('layouts.admin')

@section('title') AdminPage @endsection
@section('activeCategoryAdmin') active @endsection

@section('content')

<div class="content__recipe">
    <div class="recipe__start">
        <h3 class="recipe__title">Категории</h3>
        <a href="{{ route('admin.categoryCreate', ['id' => $user->id])}}" class="btn btn-outline-secondary">Создать категорию</a>
    </div>
    <form class="d-flex recipe__search" method="GET" action="{{ route('admin.searchCategory', ['id' => $user->id]) }}" role="search">
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
                <th>Название категории</th>
                <th>Автор категории</th>
                <th>Дата создания категории</th>
                <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category as $val)
            <tr>
                <th scope="row">{{ $val->id }}</th>
                <th style="font-weight: 400">{{ $val->name }}</th>
                <th style="font-weight: 400">{{ $val->user[0]->login }}</th>
                <td><time datetime="{{ $val->created_at }}">{{ $val->created_at }}</time></td>
                <td><a href="{{ route('catalog.showCategory', ['id' => $val->id]) }}" class="btn btn-outline-success">Рецепты</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</div>
@endsection
