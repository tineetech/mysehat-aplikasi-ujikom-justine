@extends('layouts.main')

@section('title', 'Produk — MySehat')

@section('content')
<div class="px-4 max-w-6xl mx-auto pt-12 md:pt-16 pb-20">
  <span class="card inline-block rounded-full px-4 py-1.5 text-xs font-medium">Produk</span>
  <h1 class="text-3xl md:text-5xl font-bold tracking-tight mt-5 leading-tight">Katalog obat &amp; alat pendukung</h1>
  <p class="muted text-sm md:text-base mt-3 max-w-xl">Klik produk untuk memesan lewat WhatsApp.</p>

  @php
    $labelKategori = fn($k) => match($k) { 'obat' => 'Obat', 'alat_bantu' => 'Alat', 'perban' => 'Perban', default => ucfirst($k ?? '-') };
    $artKategori = fn($k) => match($k) { 'obat' => 'capsule', 'alat_bantu' => 'bp', 'perban' => 'tablet', default => 'capsule' };
  @endphp

  @if($produk->count())
    <div id="grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-10" aria-live="polite">
      @foreach($produk as $p)
        @php
          $tipe = $labelKategori($p->kategori);
          $img = $p->gambar ? asset('storage/' . $p->gambar) : 'https://picsum.photos/seed/mysehat-p' . $p->id . '/600/450';
          $wa = 'https://wa.me/6287774487198?text=' . urlencode('Halo, saya mau membeli produk ' . $p->nama . '.');
        @endphp
        <a href="{{ $wa }}" target="_blank" rel="noopener" aria-label="Beli {{ $p->nama }} via WhatsApp" class="card rounded-3xl p-3 block hover:shadow-lg hover:-translate-y-0.5 transition">
          <div class="relative aspect-[4/3] rounded-2xl grid place-items-center overflow-hidden" style="background:linear-gradient(135deg,#c8efe8,#bfe4f5)">
            @if($p->kategori === 'obat')
              <svg viewBox="0 0 120 90" class="h-3/4" role="img" aria-label="{{ $p->nama }}"><g transform="rotate(-30 60 45)"><rect x="22" y="32" width="76" height="26" rx="13" fill="#fff"/><path d="M60 32h25a13 13 0 010 26H60z" fill="#0f766e"/></g><circle cx="98" cy="70" r="6" fill="#5eead4"/></svg>
            @elseif($p->kategori === 'alat_bantu')
              <svg viewBox="0 0 120 90" class="h-3/4" role="img" aria-label="{{ $p->nama }}"><rect x="33" y="14" width="54" height="52" rx="12" fill="#fff"/><circle cx="60" cy="38" r="15" fill="#c8efe8" stroke="#0f766e" stroke-width="3"/><path d="M60 38l8-7" stroke="#0f766e" stroke-width="3" stroke-linecap="round"/><rect x="46" y="72" width="28" height="6" rx="3" fill="#0f766e"/></svg>
            @else
              <svg viewBox="0 0 120 90" class="h-3/4" role="img" aria-label="{{ $p->nama }}"><rect x="20" y="18" width="80" height="54" rx="8" fill="#fff"/><g fill="#5eead4"><circle cx="38" cy="36" r="7"/><circle cx="60" cy="36" r="7"/><circle cx="82" cy="36" r="7"/><circle cx="38" cy="55" r="7"/><circle cx="60" cy="55" r="7"/><circle cx="82" cy="55" r="7"/></g></svg>
            @endif
            <img src="{{ $img }}" alt="{{ $p->nama }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover rounded-2xl">
            <span class="absolute z-10 left-3 top-3 rounded-full bg-white px-3 py-1 text-[11px] font-semibold" style="color:#0f2b29">{{ $tipe }}</span>
          </div>
          <div class="px-2 pt-4 pb-2">
            <h3 class="font-bold">{{ $p->nama }}</h3>
            <p class="text-xs muted mt-1">Stok tersedia: {{ $p->stok }}</p>
            <div class="flex items-center justify-between mt-4">
              <span class="text-lg font-extrabold text-brand">Rp{{ number_format($p->harga, 0, ',', '.') }}</span>
              <span class="bg-brand text-white rounded-full px-4 py-2 text-xs font-semibold inline-flex items-center gap-2"><i class="fa-brands fa-whatsapp"></i>Beli</span>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
      <p id="info" class="text-sm muted">Menampilkan {{ $produk->firstItem() }}–{{ $produk->lastItem() }} dari {{ $produk->total() }} produk</p>
      <nav id="pager" aria-label="Pagination" class="flex items-center gap-1.5 flex-wrap">
        @php $btnBase = 'min-w-9 h-9 px-3 rounded-full text-sm font-semibold grid place-items-center '; @endphp
        @if($produk->onFirstPage())
          <span class="{{ $btnBase }}muted opacity-40" aria-disabled="true"><i class="fa-solid fa-chevron-left text-xs"></i></span>
        @else
          <a href="{{ $produk->previousPageUrl() }}" aria-label="Halaman sebelumnya" class="{{ $btnBase }}card hover:shadow"><i class="fa-solid fa-chevron-left text-xs"></i></a>
        @endif
        @for($i = 1; $i <= $produk->lastPage(); $i++)
          @if($i == $produk->currentPage())
            <span aria-current="page" class="{{ $btnBase }}bg-brand text-white">{{ $i }}</span>
          @else
            <a href="{{ $produk->url($i) }}" aria-label="Halaman {{ $i }}" class="{{ $btnBase }}card hover:shadow">{{ $i }}</a>
          @endif
        @endfor
        @if($produk->hasMorePages())
          <a href="{{ $produk->nextPageUrl() }}" aria-label="Halaman berikutnya" class="{{ $btnBase }}card hover:shadow"><i class="fa-solid fa-chevron-right text-xs"></i></a>
        @else
          <span class="{{ $btnBase }}muted opacity-40" aria-disabled="true"><i class="fa-solid fa-chevron-right text-xs"></i></span>
        @endif
      </nav>
    </div>
  @else
    <div class="card rounded-3xl p-10 mt-10 text-center">
      <p class="font-bold text-lg">Belum ada produk tersedia</p>
      <p class="muted text-sm mt-2">Silakan kembali lagi nanti atau hubungi kami via WhatsApp.</p>
    </div>
  @endif
</div>
@endsection
