@props(['username' => 'Guest'])

<header class="topbar">
    <a class="logo" href="{{ route('dashboard', ['username' => $username]) }}">LEVEL<b>UP</b></a>
    <nav class="menu">
        <a href="{{ route('dashboard', ['username' => $username]) }}" @class(['on' => request()->routeIs('dashboard')])>Beranda</a>
        <a href="{{ route('pengelolaan', ['username' => $username]) }}" @class(['on' => request()->routeIs('pengelolaan')])>Kelola Produk</a>
        <a href="{{ route('profile', ['username' => $username]) }}" @class(['on' => request()->routeIs('profile')])>Akun</a>
    </nav>
    <div class="who">
        <span class="chip">{{ $username }}</span>
        <a class="out" href="{{ route('login') }}">Keluar</a>
    </div>
</header>
