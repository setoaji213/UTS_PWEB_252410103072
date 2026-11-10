@props(['product'])

<article class="pcard">
    <div class="cover {{ strtolower($product['platform']) }}">
        <span class="plat">{{ $product['platform'] }}</span>
        <span class="off">-{{ $product['diskon'] }}%</span>
    </div>
    <div class="body">
        <h3>{{ $product['judul'] }}</h3>
        <p class="sub">{{ $product['kategori'] }}</p>
        <p class="price">
            <s>Rp {{ number_format($product['harga'], 0, ',', '.') }}</s>
            <b>Rp {{ number_format($product['harga_akhir'], 0, ',', '.') }}</b>
        </p>
    </div>
</article>
