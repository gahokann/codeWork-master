@include('layouts.default.head')
<body>
    <header class="header">
        <div class="header__inner container">
            <div class="header__logo">
                <a class="header__logo__text" href="{{ route('home') }}">CodeWork</a>
            </div>
            <nav class="header__nav">
                <a href="{{ route('home') }}" class="header__nav__link">Главная</a>
                <a href="#" class="header__nav__link">Новости</a>
                <a href="{{ route('catalog.show') }}" class="header__nav__link">Каталог</a>
                <a href="{{ route('profile.home') }}" class="header__nav__link">Личный кабинет</a>
            </nav>
        </div>
    </header>
    <main class="main container">
        <div class="main__text">
            <h1 class="main__title">CodeWork</h1>
            <p class="main__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, dolor?</p>
            <div class="main__btns">
                <a href="{{ route('catalog.show') }}" class="main__btn catalog">Каталог</a>
                <a href="#" class="main__btn link">Связь с нами</a>
            </div>
        </div>
        <div class="main__img">
            <img src="assets/img/Illustration.png" alt="">
        </div>

    </main>
</body>
</html>
