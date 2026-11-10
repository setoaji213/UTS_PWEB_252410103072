<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
    <title>@yield('title') · LevelUp Store</title>
</head>
<body class="@yield('body-class')">
    @hasSection('hide-navbar')
    @else
        <x-navbar :username="$username ?? 'Guest'" />
    @endif

    <main class="page">
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
