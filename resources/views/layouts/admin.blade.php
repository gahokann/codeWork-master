@include('layouts.default.head')
<body class="body-profile">
    <main class="main-profile">
        @include('layouts.sidebars.sidebarAdmin')
        <div class="content">
            @include('layouts.navbars.navbarAdmin')
            @yield('content')
        </div>
    </main>
</body>
</html>
