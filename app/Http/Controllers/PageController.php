<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /** Data produk toko (array di controller, tanpa database). */
    private function products(): array
    {
        $data = [
            ['judul' => 'Elden Ring',            'kategori' => 'Action RPG',   'platform' => 'PC',     'harga' => 579000, 'diskon' => 20, 'stok' => 24],
            ['judul' => 'Hades',                 'kategori' => 'Roguelike',    'platform' => 'PC',     'harga' => 189000, 'diskon' => 0,  'stok' => 40],
            ['judul' => 'Stardew Valley',        'kategori' => 'Simulasi',     'platform' => 'Switch', 'harga' => 135000, 'diskon' => 15, 'stok' => 3],
            ['judul' => 'EA FC 25',              'kategori' => 'Olahraga',     'platform' => 'PS5',    'harga' => 849000, 'diskon' => 30, 'stok' => 0],
            ['judul' => 'Zelda: Tears of the Kingdom', 'kategori' => 'Adventure', 'platform' => 'Switch', 'harga' => 899000, 'diskon' => 0, 'stok' => 12],
            ['judul' => 'Hollow Knight',         'kategori' => 'Metroidvania', 'platform' => 'Switch', 'harga' => 149000, 'diskon' => 10, 'stok' => 5],
            ['judul' => 'Cyberpunk 2077',        'kategori' => 'Action RPG',   'platform' => 'PS5',    'harga' => 459000, 'diskon' => 40, 'stok' => 18],
            ['judul' => 'Celeste',               'kategori' => 'Platformer',   'platform' => 'PC',     'harga' => 95000,  'diskon' => 0,  'stok' => 30],
        ];

        return array_map(function ($p) {
            $p['harga_akhir'] = (int) round($p['harga'] * (100 - $p['diskon']) / 100);
            $p['status'] = $p['stok'] === 0 ? 'Habis' : ($p['stok'] <= 5 ? 'Menipis' : 'Tersedia');
            return $p;
        }, $data);
    }

    public function login()
    {
        return view('login', ['username' => 'Guest']);
    }

    public function authenticate(Request $request)
    {
        $request->validate(['username' => 'required|min:3'], [
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
        ]);

        return redirect()->route('dashboard', ['username' => $request->input('username')]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username', 'Guest');
        $products = $this->products();

        $stats = [
            ['label' => 'Judul di katalog', 'value' => count($products)],
            ['label' => 'Perlu restock', 'value' => count(array_filter($products, fn ($p) => $p['status'] !== 'Tersedia'))],
            ['label' => 'Nilai stok (Rp)', 'value' => number_format(array_sum(array_map(fn ($p) => $p['harga_akhir'] * $p['stok'], $products)), 0, ',', '.')],
        ];

        $promo = array_filter($products, fn ($p) => $p['diskon'] > 0);
        usort($promo, fn ($a, $b) => $b['diskon'] <=> $a['diskon']);
        $hero = $promo[0];
        $promo = array_slice($promo, 1, 3);

        return view('dashboard', compact('username', 'stats', 'hero', 'promo'));
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username', 'Guest');
        $kategori = $request->query('kategori');
        $products = $this->products();

        $daftarKategori = array_values(array_unique(array_column($products, 'kategori')));

        if ($kategori) {
            $products = array_values(array_filter($products, fn ($p) => $p['kategori'] === $kategori));
        }

        return view('pengelolaan', compact('username', 'products', 'daftarKategori', 'kategori'));
    }

    public function profile(Request $request)
    {
        $username = $request->query('username', 'Guest');

        $info = [
            'Nama Akun' => $username,
            'Jabatan' => 'Kasir & Admin Stok',
            'Cabang' => 'LevelUp Jember',
            'Shift' => 'Pagi (08.00 - 16.00)',
            'Login Terakhir' => now()->format('H:i, d M Y'),
        ];

        return view('profile', compact('username', 'info'));
    }
}
