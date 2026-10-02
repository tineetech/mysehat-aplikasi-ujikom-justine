<!-- NAV -->
<header class="relative z-20 px-4 pt-4">
  <nav class="card mx-auto max-w-6xl rounded-full flex items-center justify-between pl-6 pr-2 py-2 shadow-sm">
    <a href="{{ route('home') }}" class="display flex items-center gap-2 font-extrabold text-xl text-brand">
      <i class="fa-solid fa-heart-pulse text-2xl"></i>
      MySehat
    </a>
    <ul class="hidden md:flex items-center gap-8 text-sm font-medium">
      <li>
        @if(request()->routeIs('home'))
          <a href="{{ route('home') }}" aria-current="page" class="flex items-center gap-2 text-brand"><span class="w-1.5 h-1.5 rounded-full bg-brand"></span>Beranda</a>
        @else
          <a href="{{ route('home') }}" class="muted hover:text-brand">Beranda</a>
        @endif
      </li>
      <li>
        @if(request()->routeIs('produk'))
          <a href="{{ route('produk') }}" aria-current="page" class="flex items-center gap-2 text-brand"><span class="w-1.5 h-1.5 rounded-full bg-brand"></span>Produk</a>
        @else
          <a href="{{ route('produk') }}" class="muted hover:text-brand">Produk</a>
        @endif
      </li>
      <li>
        @if(request()->routeIs('galery'))
          <a href="{{ route('galery') }}" aria-current="page" class="flex items-center gap-2 text-brand"><span class="w-1.5 h-1.5 rounded-full bg-brand"></span>Galeri</a>
        @else
          <a href="{{ route('galery') }}" class="muted hover:text-brand">Galeri</a>
        @endif
      </li>
    </ul>
    <div class="flex items-center gap-2">
      <button id="themeBtn" aria-label="Ganti tema" class="w-9 h-9 rounded-full grid place-items-center hover:bg-black/5">
        <i class="fa-solid fa-moon"></i>
      </button>
      <a href="/admin" class="hidden sm:inline-block bg-brand text-white card rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm hover:shadow">Mulai Sekarang</a>
      <button id="menuBtn" aria-label="Buka menu" class="md:hidden w-9 h-9 rounded-full grid place-items-center hover:bg-black/5">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </nav>
  <div id="mobileMenu" class="hidden md:hidden card mx-auto max-w-6xl rounded-3xl mt-2 p-4 text-sm font-medium space-y-3">
    <a href="{{ route('home') }}" class="block {{ request()->routeIs('home') ? 'text-brand' : '' }}">Beranda</a>
    <a href="{{ route('produk') }}" class="block {{ request()->routeIs('produk') ? 'text-brand' : '' }}">Produk</a>
    <a href="{{ route('galery') }}" class="block {{ request()->routeIs('galery') ? 'text-brand' : '' }}">Galeri</a>
  </div>
</header>
