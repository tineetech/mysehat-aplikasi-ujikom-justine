@extends('layouts.main')

@section('title', 'Galeri — MySehat')

@section('content')
<style>
.shot img { transition: transform .6s ease; }
.shot:hover img { transform: scale(1.04); }
.shot .cap { opacity: 0; transition: opacity .3s; background: linear-gradient(0deg, rgba(6,47,44,.65), transparent); }
.shot:hover .cap, .shot:focus-visible .cap { opacity: 1; }
@media (hover: none) { .shot .cap { opacity: 1; } }
</style>

<div class="px-4 max-w-6xl mx-auto pt-12 md:pt-16 pb-20">
  <div>
    <span class="card inline-block rounded-full px-4 py-1.5 text-xs font-medium">Galeri</span>
    <h1 class="text-3xl md:text-5xl font-bold tracking-tight mt-5 leading-tight">Galeri fasilitas rumah sakit</h1>
  </div>

  @if($galery->count())
    <div id="gal" class="columns-1 sm:columns-2 lg:columns-3 gap-4 mt-10">
      @foreach($galery as $i => $g)
        @php $img = $g->file_path ? asset('storage/' . $g->file_path) : 'https://picsum.photos/seed/mysehat-gal' . $g->id . '/1000/800'; @endphp
        <button data-i="{{ $i }}" class="shot group relative block w-full mb-4 overflow-hidden rounded-xl break-inside-avoid text-left card" aria-label="Lihat {{ $g->nama }}">
          <div class="relative" style="aspect-ratio:4/3;background:linear-gradient(135deg,#c8efe8,#bfe4f5)">
            <div class="absolute inset-0 grid place-items-center text-5xl" style="color:rgba(15,118,110,.35)"><i class="fa-solid fa-image"></i></div>
            <img src="{{ $img }}" alt="{{ $g->nama }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover">
          </div>
          <span class="cap absolute inset-x-0 bottom-0 p-4 pt-12 text-white text-sm font-semibold">{{ $g->nama }}</span>
        </button>
      @endforeach
    </div>
  @else
    <div class="card rounded-3xl p-10 mt-10 text-center">
      <p class="font-bold text-lg">Belum ada foto galeri</p>
      <p class="muted text-sm mt-2">Silakan kembali lagi nanti.</p>
    </div>
  @endif
</div>

<!-- Lightbox -->
<div id="lb" class="hidden fixed inset-0 z-50 items-center justify-center p-4 md:p-10" style="background:rgba(6,25,23,.92)" role="dialog" aria-modal="true" aria-label="Pratinjau foto">
  <button id="lbClose" aria-label="Tutup" class="absolute top-4 right-4 w-11 h-11 rounded-full text-white hover:bg-white/15 text-lg"><i class="fa-solid fa-xmark"></i></button>
  <button id="lbPrev" aria-label="Foto sebelumnya" class="absolute left-3 md:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full text-white hover:bg-white/15"><i class="fa-solid fa-chevron-left"></i></button>
  <button id="lbNext" aria-label="Foto berikutnya" class="absolute right-3 md:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full text-white hover:bg-white/15"><i class="fa-solid fa-chevron-right"></i></button>
  <figure class="max-w-5xl w-full text-center">
    <div id="lbMedia" class="relative mx-auto w-full max-h-[78vh] rounded-xl overflow-hidden"></div>
    <figcaption id="lbCap" class="text-white/90 text-sm mt-4 font-medium"></figcaption>
  </figure>
</div>
@endsection

@push('scripts')
<script>
const G = @json($galery->map(fn($g) => ['cap' => $g->nama, 'img' => $g->file_path ? asset('storage/' . $g->file_path) : 'https://picsum.photos/seed/mysehat-gal' . $g->id . '/1000/800'])->values());
const gal = document.getElementById('gal');
const lb = document.getElementById('lb');
const lbMedia = document.getElementById('lbMedia');
const lbCap = document.getElementById('lbCap');

function media(g) {
  return `<div class="relative w-full" style="aspect-ratio:4/3;background:#0b2b29"><img src="${g.img}" alt="${g.cap}" class="absolute inset-0 w-full h-full object-contain">`;
}

let cur = 0;
function show(i) {
  if (!G.length) return;
  cur = (i + G.length) % G.length;
  lbMedia.innerHTML = media(G[cur]);
  lbMedia.firstElementChild.style.maxHeight = '78vh';
  lbCap.textContent = `${G[cur].cap} · ${cur + 1}/${G.length}`;
}
function open_(i) {
  show(i);
  lb.classList.remove('hidden'); lb.classList.add('flex');
  document.body.style.overflow = 'hidden';
  document.getElementById('lbClose').focus();
}
function close_() {
  lb.classList.add('hidden'); lb.classList.remove('flex');
  document.body.style.overflow = '';
}
if (gal) gal.onclick = e => { const b = e.target.closest('.shot'); if (b) open_(+b.dataset.i); };
document.getElementById('lbClose').onclick = close_;
document.getElementById('lbPrev').onclick = () => show(cur - 1);
document.getElementById('lbNext').onclick = () => show(cur + 1);
lb.onclick = e => { if (e.target === lb) close_(); };
document.addEventListener('keydown', e => {
  if (lb.classList.contains('hidden')) return;
  if (e.key === 'Escape') close_();
  if (e.key === 'ArrowLeft') show(cur - 1);
  if (e.key === 'ArrowRight') show(cur + 1);
});
</script>
@endpush
