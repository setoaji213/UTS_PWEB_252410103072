@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
    <h1 class="h1">Kelola Produk</h1>
    <p class="lead">{{ count($products) }} produk ditampilkan. Pengelola: <strong>{{ $username }}</strong></p>

    <div class="filters">
        <a href="{{ route('pengelolaan', ['username' => $username]) }}" @class(['on' => !$kategori])>Semua</a>
        @foreach ($daftarKategori as $k)
            <a href="{{ route('pengelolaan', ['username' => $username, 'kategori' => $k]) }}" @class(['on' => $kategori === $k])>{{ $k }}</a>
        @endforeach
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Judul</th><th>Platform</th><th>Harga</th><th>Diskon</th><th>Stok</th><th>Status</th></tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $p['judul'] }}</strong><br><small>{{ $p['kategori'] }}</small></td>
                        <td>{{ $p['platform'] }}</td>
                        <td>Rp {{ number_format($p['harga_akhir'], 0, ',', '.') }}</td>
                        <td>{{ $p['diskon'] > 0 ? $p['diskon'].'%' : '-' }}</td>
                        <td>{{ $p['stok'] }}</td>
                        <td><span class="st {{ strtolower($p['status']) }}">{{ $p['status'] }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
