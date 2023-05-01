@include('layouts.default.head')
<body class="body-profile">
    <main class="main-profile">
        @include('layouts.sidebars.sidebar')
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>
</html>
