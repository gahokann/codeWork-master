<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Auth</title>
</head>
<body class="body-auth">
    <header class="header">
        <div class="header__inner container">
            <div class="header__logo">
                <a class="header__logo__text auth" href="#">CodeWork</a>
            </div>
            <nav class="header__nav">
                <a href="#" class="header__nav__link auth">Главная</a>
                <a href="{{ route('catalog.show') }}" class="header__nav__link auth">Каталог</a>
                <a href="{{ route('profile.home') }}" class="header__nav__link auth">Личный кабинет</a>
            </nav>
        </div>
    </header>
    <main class="main-auth container">
        <p class="main__subtitle-auth">Регистрация</p>
        <form action="{{ route('register') }}" method="POST" class="main__form">
            @csrf
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="email" name="email" placeholder="Введите почту" class="main__form__input">
            @error('login')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="login" placeholder="Введите логин" class="main__form__input">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="name" placeholder="Введите имя" class="main__form__input">
            @error('birth')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="date" name="birth" placeholder="Введите дату рождения" class="main__form__input">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="password" name="password" placeholder="Введите пароль" class="main__form__input">
            <input type="password" name="password_confirmation"  placeholder="Повторите пароль" class="main__form__input">
            <button class="main__form__btn btn btn-outline-success">Регистрация</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
