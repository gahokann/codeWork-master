@extends('layouts.profile')

@section('title') myRecipe @endsection
@section('activePanelAdminAdmin') active @endsection

@section('content')

<div class="content__recipe">
    <div class="recipe__start mb-3">
        <h3 class="recipe__title">Редактирование рецепта</h3>
    </div>
        <form action="{{ route('admin.update', ['id' => $recipe->id]) }}" method="POST" class="form__recipe">
            @csrf
            @method('patch')
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Автор</label>
                <input type="text" class="form-control" value="{{ $recipe->user->login }}" disabled>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Заголовок</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите заголовок" value="{{ $recipe->title }}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Язык программирования</label>
                <select onchange="changeMode()" id="language_select" class="form-select" aria-label="Default select example">
                    <option selected>Выберите</option>
                    @foreach ($language as $val)
                        <option {{ $recipe->language->full_name == $val->full_name ? 'selected=selected' : "" }} value="{{ $val->abbreviatedEdit }}">{{ $val->full_name }}</option>
                    @endforeach
                  </select>
            </div>
            <div style="display: none" class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Описание</label>
                <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите описание" value="{{ $recipe->description }}">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-4 input__form__recipe">
                <label for="exampleInputEmail1">Код</label>
                <textarea name="code" id="code">{{ $recipe->code }}</textarea>
                @error('code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success" style="margin-bottom: 100px">Изменить</button>
        </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.11.2/ace.js" type="text/javascript" charset="utf-8"></script>
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
