@extends('layouts.profile')

@section('title') Settings @endsection
@section('activeSettings') active @endsection

@section('content')
<div class="content__settings">
    <h1 class="setting__title">Настройки</h1>
    <div class="content__inner">
       <div class="settings__items">

        <div class="settings__item">
            <h3 class="settings__item__title">Смена пароля</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('patch')
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Введите текущий пароль</label>
                  <input type="password" class="form-control" name='old_password' id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Введите новый пароль</label>
                    <input type="password" class="form-control" name='password' id="exampleInputPassword1">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Повторите новый пароль</label>
                  <input type="password" class="form-control" name='password_confirmation' id="exampleInputPassword1">
                </div>
                <input type="hidden" name="change" value="password">
                <button type="submit" class="btn btn-primary">Подтвердить</button>
              </form>
        </div>
        <div class="settings__item">
            <h3 class="settings__item__title">Смена почты</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('patch')
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Введите текущий пароль</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" name="current_password" aria-describedby="emailHelp">
                  @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Введите новую почту</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <input type="hidden" name="change" value="email">
                <button type="submit" class="btn btn-primary">Подтвердить</button>
              </form>
        </div>
        <!-- <div class="settings__item">
            <h3 class="settings__item__title">Смена почты</h3>
        </div> -->
    </div>
    <div class="settings__items">
        <div class="settings__item no-last">
            <h3 class="settings__item__title">Изображение</h3>
            <form action="{{ route('profile.addImage', ['id' =>$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p style="margin-bottom: 10px; font-weight: 700">Изображение допускается в размерах 350px x 250px</p>
                <label for="#" style="margin-bottom: 5px">Выбрать изображение</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="file" id="inputGroupFile02">
                </div>
                <button class="btn btn-outline-success">Добавить</button>
            </form>
        </div>
        <!-- <div class="settings__item">
            <h3 class="settings__item__title">Смена почты</h3>
        </div> -->
    </div>
    </div>

</div>
@endsection
