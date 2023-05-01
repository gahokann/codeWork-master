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
                <a href="#" class="header__nav__link auth">Новости</a>
                <a href="#" class="header__nav__link auth">Каталог</a>
                <a href="{{ route('profile.home') }}" class="header__nav__link auth">Личный кабинет</a>
            </nav>
        </div>
    </header>
    <main class="main-auth container">
        <p class="main__subtitle-auth">Авторизация</p>
        <form action="{{ route('login') }}" method="POST" class="main__form">
            @csrf
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input placeholder="Введите почту" value="{{ old('email') }}" class="main__form__input" id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Введите пароль"  class="main__form__input" id="password" type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <button type="submit" class="main__form__btn btn btn-outline-success">Авторизация</button>
        </form>
        <a href="{{ route('register') }}" class="form__link">Регистрация</a>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
