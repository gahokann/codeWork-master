@extends('layouts.admin')

@section('title') AdminPage @endsection
@section('activeMain') active @endsection

@section('content')
    <div class="admin">
        <h1 class="admin__title">Главная</h1>
        <div class="admin__items">
            <div class="admin__item">
                <h4 class="admin__item__title">Информация</h4>
                <div class="admin__item__info">
                    <p class="admin__info__title">Ваша роль</p>
                    <p class="admin__info__subtitle">{{ $user->role->role_name }}</p>
                    <p class="admin__info__title">Информация о роли</p>
                    <p class="admin__info__subtitle">{{ $user->role->role_info }}</p>
                </div>
            </div>
            <div class="admin__item">
                <h4 class="admin__item__title">Общая информация</h4>
                <div class="admin__item__info">
                    <p class="admin__info__title">Количество пользователей</p>
                    <a href="{{ route('admin.users', ['id' => $user->id]) }}"><p class="admin__info__subtitle">{{ $column['user'] }}</p></a>
                    <p class="admin__info__title">Количество постов</p>
                    <a href="{{ route('admin.recipes', ['id' => $user->id]) }}"><p class="admin__info__subtitle">{{ $column['recipe'] }}</p></a>
                    <p class="admin__info__title">Количество тегов</p>
                    <a href="{{ route('admin.tags', ['id' => $user->id]) }}"><p class="admin__info__subtitle">{{ $column['tag'] }}</p></a>
                </div>
            </div>
        </div>
        {{-- <div class="admin__item__sled">
            <h1 class="admin__item__title">Пользователи в топе</h1>
        </div> --}}
    </div>
@endsection
