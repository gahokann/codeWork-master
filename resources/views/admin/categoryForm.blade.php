@extends('layouts.admin')
@section('title') createCategory @endsection
@section('activeCategoryAdmin') active @endsection
@section('content')

<div class="content__recipe">
    <div class="recipe__start mb-3">
        <h3 class="recipe__title mb-5">Создание категории</h3>
    </div>

        <form action="{{ route('admin.categoryStore', ['id' => $user->id]) }}" method="POST" class="form__recipe">
            @csrf
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Название</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите заголовок">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
</div>

@endsection
