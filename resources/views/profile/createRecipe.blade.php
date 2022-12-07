@extends('layouts.profile')

@section('title') myRecipe @endsection
@section('activeMyRecipe') active @endsection

@section('content')

<div class="content__recipe">
    <h3 class="recipe__title mb-5">Создание рецепта</h3>

        <form action="{{ route('profile.store') }}" method="POST" class="form__recipe">
            @csrf
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Заголовок</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите заголовок">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Язык программирования</label>
                <select onchange="changeMode()" id="language_select" name="language" class="form-select" aria-label="Default select example">
                    <option selected>Выберите</option>
                    @foreach ($arr['language'] as $val)
                        <option value="{{ $val->abbreviatedEdit }}">{{ $val->full_name }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Описание</label>
                <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите описание">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Код</label>
                <textarea name="code" id="code"></textarea>
                @error('code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="tags">Выберите тэги</label>
                <input name='tags' id='tags' placeholder='Введите теги'>
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Категория</label>
                <select name="category" class="form-select input__form__recipe" aria-label="Default select example">
                    @foreach ($arr['category'] as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            <button type="submit" class="btn btn-success">Создать</button>
        </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.11.2/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script src="{{ asset('js/tags.js') }}"></script>
<script>
    let mode = "";

    function changeMode() {
        var select = document.getElementById('language_select');
        var value = select.options[select.selectedIndex].value;
        console.log(value)
        editor.session.setMode(`ace/mode/${value}`);
    };

    var editor = (function() {
        var textarea = document.querySelector("form textarea[name=code]");

        var editor = ace.edit()
        editor.container.style.height = "500px"
        editor.session.setValue(textarea.value)

        textarea.parentNode.insertBefore(editor.container, textarea)
        textarea.style.display = "none"

        editor.setTheme("ace/theme/chaos");
        editor.session.setMode(`ace/mode/${mode}`);

        var form = textarea
        while (form && form.localName != "form") form = form.parentNode
        form.addEventListener("submit", function() {
            textarea.value = editor.getValue()
        }, true)

        return editor;
    })();

    // window.addEventListener('load', (event) => {
    //     createEditor("code")
    // });

    console.log()




    //editor.setTheme("ace/theme/monokai");
    //editor.session.setMode("ace/mode/javascript");
</script>

@endsection
