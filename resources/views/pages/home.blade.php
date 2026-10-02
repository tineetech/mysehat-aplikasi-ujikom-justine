@extends('layouts.main')

@section('title', 'MySehat — Manajemen Rumah Sakit, Jadi Sederhana')

@section('content')
<!-- HERO -->
<section id="home" class="px-4 pt-14 md:pt-20 text-center">
  <h1 class="font-extrabold tracking-tight text-4xl sm:text-5xl md:text-6xl leading-[1.1]">
    <span class="inline-flex items-center gap-3 flex-wrap justify-center">Manajemen
      
      Rumah Sakit,</span><br>
    <span class="text-brand">Jadi Sederhana</span>
  </h1>
  <p class="muted mt-6 mx-auto max-w-xl text-sm md:text-base">Operator dan admin mengelola pasien, dokter, poli klinik, produk, dan galeri dari satu platform cloud yang andal.</p>
  <div class="mt-8 flex items-center justify-center gap-3 flex-wrap">
    <a href="#kontak" class="bg-brand hover:bg-brand-dark text-white rounded-full px-7 py-3 text-sm font-semibold inline-flex items-center gap-2">Mulai Sekarang
      <i class="fa-solid fa-arrow-right text-xs"></i></a>
    <a href="#kontak" class="card rounded-full px-7 py-3 text-sm font-semibold inline-flex items-center gap-2 shadow-sm">
      <i class="fa-solid fa-play text-[10px]"></i>Minta Demo</a>
  </div>
</section>

<!-- DASHBOARD MOCKUP -->
<section class="px-4 mt-14 md:mt-16">
  <div class="tilt card mx-auto max-w-5xl rounded-[28px] p-3 md:p-4 shadow-2xl shadow-teal-900/10 flex gap-4">
    <!-- sidebar -->
    <aside class="hidden md:block w-52 shrink-0 text-xs">
      <div class="font-extrabold text-brand text-base px-2 mb-4">MySehat</div>
      <div class="font-semibold rounded-lg px-3 py-2 mb-4 text-brand" style="background:rgba(15,118,110,.1)">Dasbor</div>
      <p class="muted px-3 mb-1">Manajemen</p>
      <ul class="space-y-1 mb-4 px-3 muted"><li class="py-1">Pasien</li><li class="py-1">Dokter</li><li class="py-1">Poli Klinik</li></ul>
      <p class="muted px-3 mb-1">Katalog</p>
      <ul class="space-y-1 mb-4 px-3 muted"><li class="py-1">Obat-obatan</li><li class="py-1">Alat Pendukung</li><li class="py-1">Assign ke Pasien</li></ul>
      <p class="muted px-3 mb-1">Konten</p>
      <ul class="space-y-1 px-3 muted"><li class="py-1">Galeri</li><li class="py-1">Pengaturan</li></ul>
    </aside>
    <!-- main -->
    <div class="flex-1 min-w-0">
      <div class="flex items-center justify-between mb-4 gap-3">
        <div class="rounded-full px-4 py-2 text-xs muted flex-1 max-w-xs" style="background:rgba(15,118,110,.07)">Cari pasien, dokter, produk…</div>
        <div class="flex items-center gap-2 text-xs"><span class="w-8 h-8 rounded-full bg-brand text-white grid place-items-center font-bold">AD</span><span class="hidden sm:block leading-tight"><b>Admin MySehat</b><br><span class="muted">admin@mysehat.id</span></span></div>
      </div>
      <h2 class="font-bold text-lg">Dasbor Admin MySehat</h2>
      <p class="muted text-xs mb-4">Ringkasan pasien, dokter, poli, dan produk</p>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="card rounded-2xl p-4"><p class="text-xs muted">Pasien Terdaftar</p><p class="text-3xl font-bold mt-3 counter" data-to="1248">0</p><p class="text-[11px] text-emerald-600 font-semibold mt-1"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs minggu lalu</p></div>
        <div class="card rounded-2xl p-4"><p class="text-xs muted">Dokter Aktif</p><p class="text-3xl font-bold mt-3 counter" data-to="42">0</p><p class="text-[11px] text-emerald-600 font-semibold mt-1"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs minggu lalu</p></div>
        <div class="card rounded-2xl p-4"><p class="text-xs muted">Poli Klinik</p><p class="text-3xl font-bold mt-3 counter" data-to="12">0</p><p class="text-[11px] text-emerald-600 font-semibold mt-1"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs minggu lalu</p></div>
        <div class="card rounded-2xl p-4"><p class="text-xs muted">Produk Tersedia</p><p class="text-3xl font-bold mt-3 counter" data-to="386">0</p><p class="text-[11px] text-emerald-600 font-semibold mt-1"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs minggu lalu</p></div>
      </div>
      <div class="grid md:grid-cols-5 gap-3 mt-3">
        <div class="card rounded-2xl p-4 md:col-span-3">
          <div class="flex items-center justify-between mb-2"><h3 class="font-semibold text-sm">Tren Kunjungan Pasien</h3>
            <div class="flex gap-1 text-[11px] rounded-full p-1" style="background:rgba(15,118,110,.08)">
              <button data-range="month" class="rangeBtn px-3 py-1 rounded-full bg-brand text-white">Bulan</button>
              <button data-range="week" class="rangeBtn px-3 py-1 rounded-full muted">Minggu</button></div></div>
          <div class="relative">
            <svg id="chart" viewBox="0 0 400 160" class="w-full h-40" preserveAspectRatio="none" role="img" aria-label="Grafik tren pendapatan">
              <defs><linearGradient id="g" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#0f766e" stop-opacity=".28"/><stop offset="1" stop-color="#0f766e" stop-opacity="0"/></linearGradient></defs>
              <path id="area" fill="url(#g)"/><path id="line" fill="none" stroke="#0f766e" stroke-width="2" vector-effect="non-scaling-stroke"/>
            </svg>
            <div id="tip" class="absolute hidden -translate-x-1/2 -translate-y-full card rounded-lg px-3 py-1.5 text-[11px] shadow-lg pointer-events-none whitespace-nowrap"></div>
          </div>
        </div>
        <div class="card rounded-2xl p-4 md:col-span-2">
          <div class="flex items-center justify-between mb-2"><h3 class="font-semibold text-sm">Arus Pasien</h3><span class="text-[11px] muted">Minggu ini</span></div>
          <div id="bars" class="h-40 flex items-end gap-2"></div>
          <div class="flex gap-2 text-[10px] muted mt-1" id="days"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CARA KAMI MEMBANTU -->
<section id="layanan" class="px-4 mt-24 max-w-6xl mx-auto">
  <span class="card inline-block rounded-full px-4 py-1.5 text-xs font-medium">Cara kami membantu</span>
  <div class="mt-5 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
    <h2 class="text-3xl md:text-4xl font-bold tracking-tight max-w-lg leading-tight">Satu panel untuk mengelola seluruh operasional rumah sakit</h2>
    <p class="muted text-sm max-w-xs">Operator dan admin MySehat mengelola pasien, dokter, poli klinik, produk, dan galeri tanpa berpindah-pindah sistem.</p>
  </div>
  <div class="grid md:grid-cols-3 gap-4 mt-10">
    <article class="card rounded-3xl p-5 flex flex-col overflow-hidden" style="background:linear-gradient(180deg,rgba(15,118,110,.07),var(--card))">
      <div class="flex items-center gap-2 text-sm muted"><i class="fa-solid fa-users"></i>Pasien</div>
      <div class="flex-1 mt-5 space-y-3">
        <div class="card rounded-2xl px-4 py-3 shadow-sm"><p class="font-semibold">Sarah Miller</p><p class="text-xs muted">Pasien: UHID-2024-1524</p></div>
        <div class="card rounded-2xl px-4 py-3 shadow-sm flex items-center gap-3 ml-4"><span class="w-9 h-9 rounded-full bg-teal-100 text-brand grid place-items-center"><i class="fa-solid fa-capsules"></i></span><div class="text-xs"><p class="font-semibold text-sm">Amoxicillin 500 mg</p><p class="muted">Di-assign · 10 kapsul</p></div></div>
      </div>
      <p class="mt-6 font-semibold leading-snug">Daftarkan pasien, catat riwayat kunjungan, dan assign produk dalam satu tempat.</p>
    </article>
    <article class="card rounded-3xl p-5 flex flex-col overflow-hidden" style="background:linear-gradient(180deg,rgba(15,118,110,.07),var(--card))">
      <div class="flex items-center gap-2 text-sm muted"><i class="fa-solid fa-user-doctor"></i>Dokter &amp; Poli</div>
      <div class="flex-1 mt-5 space-y-3">
        <div class="card rounded-2xl px-4 py-3 shadow-sm flex items-center gap-3 mr-4"><span class="w-9 h-9 rounded-full bg-teal-100 text-brand grid place-items-center"><i class="fa-solid fa-user-doctor"></i></span><div class="text-xs"><p class="font-semibold text-sm">dr. Sarah Williams</p><p class="muted">Spesialis Kardiologi</p></div></div>
        <div class="card rounded-2xl px-4 py-3 shadow-sm flex items-center gap-3 ml-4"><span class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 grid place-items-center"><i class="fa-solid fa-stethoscope"></i></span><div class="text-xs"><p class="font-semibold text-sm">Poli Jantung</p><p class="muted">12 pasien hari ini</p></div></div>
      </div>
      <p class="mt-6 font-semibold leading-snug">Atur data dokter dan poli klinik beserta jadwal praktiknya.</p>
    </article>
    <article class="rounded-3xl p-5 flex flex-col overflow-hidden text-white" style="background:linear-gradient(160deg,#0f766e,#0b5c56)">
      <div class="flex items-center gap-2 text-sm opacity-90"><i class="fa-solid fa-pills"></i>Produk</div>
      <div class="flex-1 mt-5 rounded-2xl bg-white/90 text-slate-800 p-3 text-[11px] shadow-lg min-h-[130px] space-y-2">
        <div class="flex justify-between border-b border-teal-100 pb-2"><span class="font-semibold">Amoxicillin 500 mg</span><span>Stok 120</span></div>
        <div class="flex justify-between border-b border-teal-100 pb-2"><span class="font-semibold">Tensimeter Digital</span><span>Stok 14</span></div>
        <div class="flex justify-between"><span class="font-semibold">Kursi Roda</span><span>Stok 8</span></div>
      </div>
      <p class="mt-6 font-semibold leading-snug">Katalog obat dan alat pendukung, siap di-assign ke pasien tertentu.</p>
      <p class="text-sm opacity-80 mt-1">Stok berkurang otomatis dan tercatat di riwayat pasien.</p>
    </article>
  </div>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-8 mt-14">
    <div><p class="text-4xl md:text-5xl font-semibold tracking-tight"><span class="stat" data-to="60">0</span>%</p><p class="muted text-sm mt-3">Operasional lebih efisien</p></div>
    <div><p class="text-4xl md:text-5xl font-semibold tracking-tight"><span class="stat" data-to="40">0</span>%</p><p class="muted text-sm mt-3">Sistem lebih mudah digunakan</p></div>
    <div><p class="text-4xl md:text-5xl font-semibold tracking-tight"><span class="stat" data-to="38">0</span>%</p><p class="muted text-sm mt-3">Manajemen pasien membaik</p></div>
    <div><p class="text-4xl md:text-5xl font-semibold tracking-tight"><span class="stat" data-to="80">0</span>%</p><p class="muted text-sm mt-3">Kendala operasional teratasi</p></div>
  </div>
</section>

<!-- FITUR -->
<section id="fitur" class="px-4 mt-24 max-w-6xl mx-auto">
  <div class="text-center"><h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Semua yang dibutuhkan operator &amp; admin</h2>
  <p class="muted mt-4 max-w-2xl mx-auto text-sm md:text-base">Enam modul inti yang dikelola langsung dari panel admin MySehat.</p></div>
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-10">
    <article class="card rounded-3xl p-6"><div class="w-10 h-10 rounded-xl bg-brand text-white grid place-items-center mb-4"><i class="fa-solid fa-hospital-user"></i></div><h3 class="font-bold">Manajemen pasien</h3><p class="muted text-sm mt-2">Tambah, ubah, dan cari data pasien lengkap dengan nomor rekam medis dan riwayat kunjungan.</p></article>
    <article class="card rounded-3xl p-6"><div class="w-10 h-10 rounded-xl bg-brand text-white grid place-items-center mb-4"><i class="fa-solid fa-user-doctor"></i></div><h3 class="font-bold">Manajemen dokter</h3><p class="muted text-sm mt-2">Kelola profil, spesialisasi, dan jadwal praktik setiap dokter.</p></article>
    <article class="card rounded-3xl p-6"><div class="w-10 h-10 rounded-xl bg-brand text-white grid place-items-center mb-4"><i class="fa-solid fa-stethoscope"></i></div><h3 class="font-bold">Poli klinik</h3><p class="muted text-sm mt-2">Buat poli klinik, tentukan dokter penanggung jawab, dan atur kapasitas harian.</p></article>
    <article class="card rounded-3xl p-6"><div class="w-10 h-10 rounded-xl bg-brand text-white grid place-items-center mb-4"><i class="fa-solid fa-pills"></i></div><h3 class="font-bold">Produk obat &amp; alat</h3><p class="muted text-sm mt-2">Katalog obat-obatan dan alat pendukung lengkap dengan kategori, stok, dan harga.</p></article>
    <article class="card rounded-3xl p-6"><div class="w-10 h-10 rounded-xl bg-brand text-white grid place-items-center mb-4"><i class="fa-solid fa-hand-holding-medical"></i></div><h3 class="font-bold">Assign produk ke pasien</h3><p class="muted text-sm mt-2">Berikan produk tertentu ke pasien tertentu. Stok berkurang otomatis dan tercatat di riwayat.</p></article>
    <article class="card rounded-3xl p-6"><div class="w-10 h-10 rounded-xl bg-brand text-white grid place-items-center mb-4"><i class="fa-solid fa-images"></i></div><h3 class="font-bold">Pengelolaan galeri</h3><p class="muted text-sm mt-2">Unggah, atur, dan hapus foto fasilitas dan kegiatan rumah sakit dari panel admin.</p></article>
  </div>
</section>

<!-- ANALISA GEJALA -->
<section id="analisa-gejala" class="px-4 mt-24 max-w-6xl mx-auto">
  <div class="card rounded-[2rem] p-6 md:p-10 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <span class="rounded-full px-4 py-1.5 text-xs font-semibold text-brand inline-block" style="background:rgba(15,118,110,.1)">Fitur unggulan</span>
      <h2 class="text-3xl md:text-4xl font-bold tracking-tight mt-5 leading-tight">Cek gejala pasien, dapatkan arahan poli yang tepat</h2>
      <p class="muted mt-4 text-sm md:text-base">Admin cukup menginput gejala yang dirasakan pasien. MySehat menganalisisnya, mengelompokkannya ke kategori penyakit yang mungkin, lalu menyarankan dokter atau poli klinik yang sesuai.</p>
      <ul class="mt-6 space-y-5"><li class="flex gap-4"><span class="w-10 h-10 shrink-0 rounded-xl bg-brand text-white grid place-items-center"><i class="fa-solid fa-keyboard"></i></span><div><p class="font-semibold">Admin input gejala</p><p class="muted text-sm mt-0.5">Admin menuliskan gejala yang dirasakan pasien, seperti demam, batuk, atau nyeri dada.</p></div></li><li class="flex gap-4"><span class="w-10 h-10 shrink-0 rounded-xl bg-brand text-white grid place-items-center"><i class="fa-solid fa-magnifying-glass-chart"></i></span><div><p class="font-semibold">Analisis kategori</p><p class="muted text-sm mt-0.5">Sistem mengelompokkan gejala ke kategori penyakit yang mungkin.</p></div></li><li class="flex gap-4"><span class="w-10 h-10 shrink-0 rounded-xl bg-brand text-white grid place-items-center"><i class="fa-solid fa-user-doctor"></i></span><div><p class="font-semibold">Saran dokter &amp; poli</p><p class="muted text-sm mt-0.5">Admin mengarahkan pasien ke dokter atau poli klinik yang paling sesuai.</p></div></li></ul>
      <p class="text-xs muted mt-6"><i class="fa-solid fa-circle-info mr-1"></i>Hasil analisis hanya saran awal bagi admin dan bukan diagnosis medis. Keputusan tetap ada pada dokter.</p>
    </div>
    <div class="rounded-3xl p-5" style="background:linear-gradient(135deg,rgba(15,118,110,.1),rgba(191,228,245,.35))" aria-label="Contoh tampilan fitur">
      <p class="text-[11px] muted mb-3">Contoh tampilan</p>
      <div class="card rounded-2xl p-4"><p class="text-xs muted">Gejala pasien (diinput admin)</p>
        <div class="flex flex-wrap gap-2 mt-2 text-xs"><span class="rounded-full px-3 py-1 bg-brand text-white">Demam</span><span class="rounded-full px-3 py-1 bg-brand text-white">Batuk berdahak</span><span class="rounded-full px-3 py-1 bg-brand text-white">Sesak napas</span></div></div>
      <div class="card rounded-2xl p-4 mt-3"><p class="text-xs muted">Kategori kemungkinan</p><p class="font-bold mt-1"><i class="fa-solid fa-lungs text-brand mr-2"></i>Gangguan pernapasan</p></div>
      <div class="card rounded-2xl p-4 mt-3 flex items-center gap-3"><span class="w-10 h-10 rounded-full bg-brand text-white grid place-items-center"><i class="fa-solid fa-stethoscope"></i></span><div class="text-sm"><p class="text-xs muted">Disarankan ke</p><p class="font-semibold">Poli Paru · dokter spesialis paru</p></div></div>
    </div>
  </div>
</section>

<!-- PRODUK -->
<section id="produk" class="px-4 mt-24 max-w-6xl mx-auto">
  <span class="card inline-block rounded-full px-4 py-1.5 text-xs font-medium">Produk</span>
  <h2 class="text-3xl md:text-4xl font-bold tracking-tight mt-5 max-w-2xl leading-tight">Kelola obat &amp; alat pendukung, lalu assign ke pasien yang tepat</h2>
  <p class="muted text-sm mt-3 max-w-xl">Katalog obat-obatan dan alat pendukung. Klik produk untuk memesan lewat WhatsApp.</p>
  <div class="flex gap-1 text-xs rounded-full p-1 mt-6 w-fit" style="background:rgba(15,118,110,.08)">
    <button data-f="Semua" class="fBtn px-4 py-1.5 rounded-full bg-brand text-white">Semua</button><button data-f="Obat" class="fBtn px-4 py-1.5 rounded-full muted">Obat</button><button data-f="Alat" class="fBtn px-4 py-1.5 rounded-full muted">Alat</button></div>
  @php $labelKategori = fn($k) => match($k) { 'obat' => 'Obat', 'alat_bantu' => 'Alat', 'perban' => 'Perban', default => ucfirst($k ?? '-') }; @endphp
  @if($produk->count())
    <div id="prodList" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
      @foreach($produk as $p)
        @php
          $tipe = $labelKategori($p->kategori);
          $filterTipe = $p->kategori === 'obat' ? 'Obat' : 'Alat';
          $img = $p->gambar ? asset('storage/' . $p->gambar) : 'https://picsum.photos/seed/mysehat-p' . $p->id . '/600/450';
          $wa = 'https://wa.me/6287774487198?text=' . urlencode('Halo, saya mau membeli produk ' . $p->nama . '.');
        @endphp
        <a href="{{ $wa }}" target="_blank" rel="noopener" data-type="{{ $filterTipe }}" aria-label="Beli {{ $p->nama }} via WhatsApp" class="prodCard card rounded-3xl p-3 block hover:shadow-lg hover:-translate-y-0.5 transition">
          <div class="relative aspect-[4/3] rounded-2xl grid place-items-center overflow-hidden" style="background:linear-gradient(135deg,#c8efe8,#bfe4f5)">
            @if($p->kategori === 'obat')
              <svg viewBox="0 0 120 90" class="h-3/4" role="img" aria-label="{{ $p->nama }}"><g transform="rotate(-30 60 45)"><rect x="22" y="32" width="76" height="26" rx="13" fill="#fff"/><path d="M60 32h25a13 13 0 010 26H60z" fill="#0f766e"/></g><circle cx="98" cy="70" r="6" fill="#5eead4"/></svg>
            @else
              <svg viewBox="0 0 120 90" class="h-3/4" role="img" aria-label="{{ $p->nama }}"><rect x="33" y="14" width="54" height="52" rx="12" fill="#fff"/><circle cx="60" cy="38" r="15" fill="#c8efe8" stroke="#0f766e" stroke-width="3"/><path d="M60 38l8-7" stroke="#0f766e" stroke-width="3" stroke-linecap="round"/><rect x="46" y="72" width="28" height="6" rx="3" fill="#0f766e"/></svg>
            @endif
            <img src="{{ $img }}" alt="{{ $p->nama }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover rounded-2xl">
            <span class="absolute z-10 left-3 top-3 rounded-full bg-white px-3 py-1 text-[11px] font-semibold" style="color:#0f2b29">{{ $tipe }}</span>
          </div>
          <div class="px-2 pt-4 pb-2"><h3 class="font-bold">{{ $p->nama }}</h3><p class="text-xs muted mt-1">Stok tersedia: {{ $p->stok }}</p>
            <div class="flex items-center justify-between mt-4"><span class="text-lg font-extrabold text-brand">Rp{{ number_format($p->harga, 0, ',', '.') }}</span><span class="bg-brand text-white rounded-full px-4 py-2 text-xs font-semibold inline-flex items-center gap-2"><i class="fa-brands fa-whatsapp"></i>Beli</span></div></div>
        </a>
      @endforeach
    </div>
    <div class="mt-6">
      <a href="{{ route('produk') }}" class="card rounded-full px-6 py-2.5 text-sm font-semibold inline-flex items-center gap-2 shadow-sm hover:shadow">Lihat semua produk <i class="fa-solid fa-arrow-right text-xs"></i></a>
    </div>
  @else
    <div class="card rounded-3xl p-8 mt-6 text-center"><p class="font-bold">Belum ada produk tersedia</p></div>
  @endif
</section>

<!-- GALERI -->
<section id="galeri" class="px-4 mt-24 max-w-6xl mx-auto">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
    <div><span class="card inline-block rounded-full px-4 py-1.5 text-xs font-medium">Galeri</span>
    <h2 class="text-3xl md:text-4xl font-bold tracking-tight mt-5">Galeri fasilitas rumah sakit</h2>
    <p class="muted text-sm mt-3 max-w-xl">Potret fasilitas dan kegiatan rumah sakit yang dikelola admin dari sistem.</p></div>
    <a href="{{ route('galery') }}" class="card rounded-full px-6 py-2.5 text-sm font-semibold inline-flex items-center gap-2 shadow-sm hover:shadow shrink-0">Lihat semua <i class="fa-solid fa-arrow-right text-xs"></i></a>
  </div>
  @if($galery->count())
    <div id="galGrid" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-8">
      @foreach($galery as $g)
        @php $gimg = $g->file_path ? asset('storage/' . $g->file_path) : 'https://picsum.photos/seed/mysehat-gal' . $g->id . '/800/600'; @endphp
        <figure class="group relative aspect-[4/3] rounded-3xl overflow-hidden card">
          <div class="w-full h-full grid place-items-center text-4xl" style="background:linear-gradient(135deg,#c8efe8,#bfe4f5);color:#0f766e"><i class="fa-solid fa-image"></i></div>
          <img src="{{ $gimg }}" alt="{{ $g->nama }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover">
          <figcaption class="absolute z-10 left-3 bottom-3 rounded-full bg-white px-3 py-1 text-xs font-semibold shadow" style="color:#0f2b29">{{ $g->nama }}</figcaption>
        </figure>
      @endforeach
    </div>
  @else
    <div class="card rounded-3xl p-8 mt-8 text-center"><p class="font-bold">Belum ada foto galeri</p></div>
  @endif
</section>

<!-- KISAH PASIEN -->
<section id="kisah" class="px-4 mt-24 max-w-6xl mx-auto">
  <div class="text-center"><h2 class="text-3xl md:text-4xl font-semibold tracking-tight">Kisah Pasien Kami</h2>
  <p class="muted mt-4 max-w-md mx-auto text-sm md:text-base">Pengalaman nyata dari pasien yang dilayani rumah sakit pengguna MySehat.</p></div>
  <div class="grid md:grid-cols-3 gap-4 mt-10">
    <article class="card rounded-3xl p-6 flex flex-col">
      <div class="text-amber-400 text-sm mb-4"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
      <p class="text-sm leading-relaxed flex-1">“Data anak saya sudah tersimpan, jadi saya tidak perlu mengulang cerita di setiap kunjungan. Obatnya pun langsung siap saat kami tiba.”</p>
      <div class="flex items-center gap-3 mt-6"><span class="w-10 h-10 rounded-full bg-brand text-white grid place-items-center"><i class="fa-solid fa-user"></i></span><div class="text-xs"><p class="font-semibold text-sm">Rina Wulandari</p><p class="muted">Orang tua pasien · Poli Anak</p></div></div>
    </article>
    <article class="card rounded-3xl p-6 flex flex-col">
      <div class="text-amber-400 text-sm mb-4"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
      <p class="text-sm leading-relaxed flex-1">“Alat tensimeter dari rumah sakit tercatat atas nama saya, jadi pengembalian dan kontrol berikutnya jadi jauh lebih mudah.”</p>
      <div class="flex items-center gap-3 mt-6"><span class="w-10 h-10 rounded-full bg-brand text-white grid place-items-center"><i class="fa-solid fa-user"></i></span><div class="text-xs"><p class="font-semibold text-sm">Hendra Saputra</p><p class="muted">Pasien · Poli Jantung</p></div></div>
    </article>
    <article class="card rounded-3xl p-6 flex flex-col">
      <div class="text-amber-400 text-sm mb-4"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
      <p class="text-sm leading-relaxed flex-1">“Antrean lebih singkat dan petugas langsung tahu riwayat saya. Rasanya dilayani, bukan sekadar diproses.”</p>
      <div class="flex items-center gap-3 mt-6"><span class="w-10 h-10 rounded-full bg-brand text-white grid place-items-center"><i class="fa-solid fa-user"></i></span><div class="text-xs"><p class="font-semibold text-sm">Ayu Lestari</p><p class="muted">Pasien · Poli Kandungan</p></div></div>
    </article>
  </div>
  <p class="text-center text-xs muted mt-6">*Testimoni di halaman ini adalah contoh.</p>
</section>

<!-- KONTAK -->
<section id="kontak" class="px-4 mt-24 mb-16 max-w-3xl mx-auto">
  <div class="card rounded-3xl p-8 md:p-10">
    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-center">Minta demo MySehat</h2>
    <p class="muted text-sm text-center mt-2">Tim kami akan menghubungi Anda dalam 1 hari kerja.</p>
    <div id="formArea" class="mt-6 grid gap-3">
      <input id="fName" class="card rounded-xl px-4 py-3 text-sm bg-transparent" placeholder="Nama lengkap" aria-label="Nama lengkap">
      <input id="fHosp" class="card rounded-xl px-4 py-3 text-sm bg-transparent" placeholder="Nama rumah sakit / klinik" aria-label="Nama rumah sakit">
      <input id="fMail" type="email" class="card rounded-xl px-4 py-3 text-sm bg-transparent" placeholder="Email" aria-label="Email">
      <p id="formMsg" class="text-sm hidden"></p>
      <button id="sendBtn" class="bg-brand hover:bg-brand-dark text-white rounded-full py-3 text-sm font-semibold">Kirim permintaan</button>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
// Hitung naik
document.querySelectorAll('.counter').forEach(el => {
  const to = +el.dataset.to, t0 = performance.now(), dur = 1200;
  const step = t => { const p = Math.min((t - t0) / dur, 1); el.textContent = Math.round(to * (1 - Math.pow(1 - p, 3))).toLocaleString('id-ID'); if (p < 1) requestAnimationFrame(step); };
  requestAnimationFrame(step);
});

// Grafik kunjungan
const data = {
  month: { labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'], vals: [220,280,250,340,310,400,380,470,520,490,580,650] },
  week:  { labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'], vals: [80,110,90,140,130,100,70] }
};
const line = document.getElementById('line'), area = document.getElementById('area'), tip = document.getElementById('tip'), svg = document.getElementById('chart');
let cur = 'month', pts = [];
function draw() {
  if (!line || !svg) return;
  const { vals, labels } = data[cur], max = Math.max(...vals) * 1.15;
  pts = vals.map((v, i) => [i / (vals.length - 1) * 400, 155 - v / max * 145]);
  let d = 'M' + pts[0].join(',');
  for (let i = 1; i < pts.length; i++) { const [x0, y0] = pts[i-1], [x1, y1] = pts[i], cx = (x0 + x1) / 2; d += ` C${cx},${y0} ${cx},${y1} ${x1},${y1}`; }
  line.setAttribute('d', d); area.setAttribute('d', d + ' L400,160 L0,160 Z');
  tip.classList.add('hidden');
}
if (svg) {
  svg.addEventListener('mousemove', e => {
    const r = svg.getBoundingClientRect(), x = (e.clientX - r.left) / r.width * 400;
    let idx = 0, best = 1e9; pts.forEach((p, i) => { const dd = Math.abs(p[0] - x); if (dd < best) { best = dd; idx = i; } });
    const { vals, labels } = data[cur];
    tip.innerHTML = `${labels[idx]} 2026<br><b>${vals[idx]}</b> kunjungan`;
    tip.style.left = pts[idx][0] / 400 * r.width + 'px'; tip.style.top = pts[idx][1] / 160 * r.height + 'px';
    tip.classList.remove('hidden');
  });
  svg.addEventListener('mouseleave', () => tip.classList.add('hidden'));
  document.querySelectorAll('.rangeBtn').forEach(b => b.onclick = () => {
    cur = b.dataset.range;
    document.querySelectorAll('.rangeBtn').forEach(x => { const on = x === b; x.classList.toggle('bg-brand', on); x.classList.toggle('text-white', on); x.classList.toggle('muted', !on); });
    draw();
  });
  draw();
}

// Arus pasien
const days = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'], flow = [55,70,48,85,66,40,30];
const bars = document.getElementById('bars'), dl = document.getElementById('days');
if (bars && dl) {
  flow.forEach((v, i) => {
    const b = document.createElement('div');
    b.className = 'bar flex-1 rounded-t-lg ' + (i === 3 ? 'bg-brand' : 'bg-teal-200/70'); b.style.height = '0%'; b.title = `${days[i]}: ${v*3} pasien`;
    bars.appendChild(b); setTimeout(() => b.style.height = v + '%', 100 + i * 70);
    const s = document.createElement('span'); s.className = 'flex-1 text-center'; s.textContent = days[i]; dl.appendChild(s);
  });
}

// Statistik: hitung naik saat terlihat
const io = new IntersectionObserver(es => es.forEach(e => {
  if (!e.isIntersecting) return;
  io.unobserve(e.target);
  const el = e.target, to = +el.dataset.to, t0 = performance.now();
  const step = t => { const p = Math.min((t - t0) / 1200, 1); el.textContent = Math.round(to * (1 - Math.pow(1 - p, 3))).toLocaleString('id-ID'); if (p < 1) requestAnimationFrame(step); };
  requestAnimationFrame(step);
}), { threshold: .6 });
document.querySelectorAll('.stat').forEach(el => io.observe(el));

// Filter produk beranda (client-side, data sudah dinamis dari DB)
document.querySelectorAll('.fBtn').forEach(b => b.onclick = () => {
  const f = b.dataset.f;
  document.querySelectorAll('.fBtn').forEach(x => { const on = x === b; x.classList.toggle('bg-brand', on); x.classList.toggle('text-white', on); x.classList.toggle('muted', !on); });
  document.querySelectorAll('.prodCard').forEach(c => {
    c.style.display = (f === 'Semua' || c.dataset.type === f) ? '' : 'none';
  });
});

// Form demo
const sendBtn = document.getElementById('sendBtn');
if (sendBtn) {
  sendBtn.onclick = () => {
    const n = document.getElementById('fName').value.trim(), h = document.getElementById('fHosp').value.trim(), m = document.getElementById('fMail').value.trim(), msg = document.getElementById('formMsg');
    msg.classList.remove('hidden');
    if (!n || !h || !/^\S+@\S+\.\S+$/.test(m)) { msg.className = 'text-sm text-red-600'; msg.textContent = 'Lengkapi nama, nama rumah sakit, dan email yang valid.'; return; }
    msg.className = 'text-sm text-emerald-600 font-semibold'; msg.textContent = `Terima kasih, ${n}. Permintaan demo untuk ${h} sudah diterima.`;
  };
}
</script>
@endpush
