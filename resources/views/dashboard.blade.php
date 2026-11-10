@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="hero">
        <div>
            <p class="hello">Halo, {{ $username }}. Promo terbesar hari ini:</p>
            <h1>{{ $hero['judul'] }}</h1>
            <p>{{ $hero['kategori'] }} untuk {{ $hero['platform'] }}. Stok tersisa {{ $hero['stok'] }}.</p>
        </div>
        <div class="tag">
            <span>-{{ $hero['diskon'] }}%</span>
            <s>Rp {{ number_format($hero['harga'], 0, ',', '.') }}</s>
            <b>Rp {{ number_format($hero['harga_akhir'], 0, ',', '.') }}</b>
        </div>
    </section>

    <section class="tiles">
        @foreach ($stats as $stat)
            <x-stat-tile :value="$stat['value']" :label="$stat['label']" />
        @endforeach
    </section>

    <h2 class="h2">Promo lainnya</h2>
    <section class="cards">
        @foreach ($promo as $item)
            <x-product-card :product="$item" />
        @endforeach
    </section>
@endsection
