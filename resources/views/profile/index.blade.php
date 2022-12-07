@extends('layouts.profile')

@section('title') HomePage @endsection
@section('activeMain') active @endsection


@section('content')
@if(Auth::check())
<div class="content__userInfo">
    <div class="content__userInfo__inner">
        <div>
            <img src="{{ asset('img/imageUser/'. $user->photoPath) }}" alt="" class="userInfo__img img__glav">

        </div>
        <div class="userInfo__text">
            <h2 class="userInfo__title">{{ $user->userInfo->name }}</h2>
            <p class="userInfo__email">{{ $user->email }}</p>
            <p class="userInfo__rating">Ваш рейтинг: 0</p>
            <div class="content__userInfo__role">
                @if($user->id == Auth::user()->id)
                <h3 class="userInfo__role__title">Ваш уровень доступа: {{ $user->role->role_name }}</h3>
                <p class="userInfo__role__text">{{ $user->role->role_info }}</p>
                @else
                <h3 class="userInfo__role__title" style="margin-bottom: 0">Уровень доступа: {{ $user->role->role_name }}</h3>
                @if(Auth::user()->isAdmin())
                        <p style="margin-top: 15px; font-weight:700">Поменять уровень доступа</p>
                        <form style="margin-top: 15px" action="{{ route('admin.addRoles', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <select required class="form-select" name="role" aria-label="Default select example">
                                <option selected>Выберите</option>
                                @foreach ($role as $val)
                                    <option
                                    value="{{ $val->id }}">{{ $val->role_name }}</option>
                                @endforeach
                            </select>
                            <button style="margin-top: 15px" class="btn btn-success" type="submit">Изменить</button>
                        </form>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
@else
<div class="content__userInfo">
    <div class="content__userInfo__inner">
        <img src="{{ asset('img/imageUser/'. $user->photoPath) }}" alt="" class="userInfo__img img__glav">
        <div class="userInfo__text">
            <h2 class="userInfo__title">{{ $user->userInfo->name }}</h2>
            <p class="userInfo__email">{{ $user->email }}</p>
            <p class="userInfo__rating">Рейтинг: 0</p>
            <div class="content__userInfo__role">
                <h3 class="userInfo__role__title" style="margin-bottom: 0">Уровень доступа: {{ $user->role->role_name }}</h3>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
