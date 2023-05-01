@include('layouts.default.head')

<body class="body-profile">

    <main class="main-profile">

        @if(Request::is('catalog/show/recipe/*'))
            @include('layouts.sidebars.sidebar')
        @else
        @include('layouts.sidebars.sidebarCatalog')
        @endif
        <div class="content">

            @yield('content')

        </div>
    </main>

</body>

</html>
