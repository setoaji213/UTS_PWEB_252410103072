@extends('layouts.app')

@section('title', 'Masuk')
@section('body-class', 'login-page')
@section('hide-navbar', true)

@section('content')
    <section class="login-wrap">
        <div class="login-promo">
            <p class="logo">LEVEL<b>UP</b></p>
            <h1>Rak game kamu, semua dalam satu layar.</h1>
            <p>Cek harga, atur stok, dan pantau diskon harian toko.</p>
        </div>

        <form class="login-form" method="POST" action="{{ route('login.process') }}">
            @csrf
            <h2>Masuk ke kasir</h2>
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" autofocus>
            @error('username')
                <small class="error">{{ $message }}</small>
            @enderror
            <button type="submit">Masuk</button>
        </form>
    </section>
@endsection
