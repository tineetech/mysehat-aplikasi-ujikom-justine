<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>@yield('title', 'MySehat — Manajemen Rumah Sakit, Jadi Sederhana')</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = { theme: { extend: {
  fontFamily: { sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'] },
  colors: { brand: { DEFAULT: '#0f766e', dark: '#0b5c56', light: '#5eead4' } }
}}};
</script>
<style>
:root { box-sizing: border-box; padding-top: env(safe-area-inset-top, 0px); padding-bottom: env(safe-area-inset-bottom, 0px); --bg1:#e6f7f4; --bg2:#c9ece6; --ink:#1f2b2a; --muted:#5b6d6b; --card:#ffffff; --line:#e3efed; }
:root[data-theme="dark"] { --bg1:#0c1f1e; --bg2:#0f2e2b; --ink:#e8f5f3; --muted:#9bb5b1; --card:#132a28; --line:#1f3d3a; }
html { scroll-behavior: smooth; scroll-padding-top: 90px; }
body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; color: var(--ink); background: linear-gradient(180deg, var(--bg2) 0%, var(--bg1) 45%, var(--bg1) 100%); min-height: 100vh; }
button, input { font-family: inherit; }
.card { background: var(--card); border: 1px solid var(--line); }
.muted { color: var(--muted); }
.stripes { background-image: repeating-linear-gradient(90deg, rgba(255,255,255,.28) 0 2px, transparent 2px 90px); }
:root[data-theme="dark"] .stripes { background-image: none; }
.orbs { display: none; }
:root[data-theme="dark"] .orbs { display: block; }
.orb { position: fixed; border-radius: 9999px; background: rgba(94,234,212,.07); border: 1px solid rgba(94,234,212,.18); }
.tilt { transform: perspective(1600px) rotateX(9deg) rotateZ(-1.2deg); transform-origin: top center; }
@media (max-width: 767px) { .tilt { transform: none; } }
.bar { transition: height .5s ease; }
@media (prefers-reduced-motion: reduce) { * { transition: none !important; scroll-behavior: auto !important; } }
:focus-visible { outline: 2px solid #0f766e; outline-offset: 2px; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer crossorigin="anonymous"></script>
</head>
<body>
<div class="stripes fixed inset-0 pointer-events-none" aria-hidden="true"></div>
<div class="orbs pointer-events-none" aria-hidden="true">
  <span class="orb" style="width:280px;height:280px;top:-70px;right:-60px"></span>
  <span class="orb" style="width:150px;height:150px;top:46%;left:-40px"></span>
  <span class="orb" style="width:90px;height:90px;bottom:12%;right:8%"></span>
</div>

@include('partials.navbar')

<main class="relative z-10">
  @yield('content')
</main>

@include('partials.chatbot')

@include('partials.footer')

<script>
// Menu mobile
const mm = document.getElementById('mobileMenu');
if (mm && document.getElementById('menuBtn')) {
  document.getElementById('menuBtn').onclick = () => mm.classList.toggle('hidden');
  mm.querySelectorAll('a').forEach(a => a.onclick = () => mm.classList.add('hidden'));
}

// Tema
const root = document.documentElement;
const themeBtn = document.getElementById('themeBtn');
if (themeBtn) {
  themeBtn.onclick = () => {
    const dark = root.dataset.theme === 'dark';
    root.dataset.theme = dark ? 'light' : 'dark';
    themeBtn.innerHTML = `<i class="fa-solid fa-${dark ? 'moon' : 'sun'}"></i>`;
  };
}
</script>

<script>
// Chatbot FAQ (global, dipakai di semua halaman)
const FAQ = [
  {k:['apa itu','mysehat','tentang','platform'], q:'Apa itu MySehat?', a:'MySehat adalah platform cloud untuk manajemen rumah sakit. Operator dan admin dapat mengelola pasien, dokter, poli klinik, produk (obat dan alat pendukung), serta galeri dari satu panel.'},
  {k:['siapa','pengguna','operator','admin'], q:'Siapa yang menggunakan sistem MySehat?', a:'Sistem pengelolaan, termasuk analisis gejala, dipakai oleh operator atau admin rumah sakit. Pengunjung dapat melihat katalog produk di halaman publik.'},
  {k:['fitur','modul','bisa apa'], q:'Fitur apa saja yang tersedia?', a:'Manajemen pasien, manajemen dokter, poli klinik, katalog produk obat dan alat pendukung, assign produk ke pasien, pengelolaan galeri, serta analisis gejala untuk saran poli.'},
  {k:['gejala','analisa','analisis','penyakit','poli apa'], q:'Bagaimana fitur analisis gejala bekerja?', a:'Admin menginput gejala yang dirasakan pasien. Sistem mengelompokkannya ke kategori penyakit yang mungkin lalu menyarankan dokter atau poli yang sesuai. Ini hanya saran awal, bukan diagnosis medis.'},
  {k:['beli','pesan','order','produk','obat','alat','whatsapp','wa'], q:'Bagaimana cara membeli produk?', a:'Buka bagian Produk, lalu klik produk yang diinginkan. Anda akan diarahkan ke WhatsApp (087774487198) dengan pesan pembelian sesuai nama produk.'},
  {k:['assign','pasien tertentu','pos'], q:'Bagaimana produk diberikan ke pasien?', a:'Penugasan produk ke pasien tertentu dilakukan oleh admin di sistem admin atau POS, bukan di halaman publik ini.'},
  {k:['galeri','foto'], q:'Siapa yang mengelola galeri?', a:'Galeri fasilitas dan kegiatan rumah sakit dikelola oleh admin melalui sistem MySehat.'},
  {k:['demo','coba','daftar','kontak','hubungi'], q:'Bagaimana meminta demo?', a:'Klik tombol Minta Demo di bagian atas atau isi formulir di bagian Kontak. Tim kami akan menghubungi Anda.'},
  {k:['harga','biaya','paket','langganan'], q:'Berapa biaya menggunakan MySehat?', a:'Biaya disesuaikan dengan kebutuhan rumah sakit atau klinik Anda. Silakan minta demo agar tim kami dapat memberi penawaran.'},
  {k:['aman','keamanan','privasi','data'], q:'Apakah data pasien aman?', a:'Detail keamanan dan kepatuhan dapat dijelaskan oleh tim kami saat sesi demo. Silakan hubungi kami melalui tombol Minta Demo.'}
];
const chatHist = [];
let sampleP = (window.claude && claude.use) ? claude.use('sample').catch(() => null) : Promise.resolve(null);
function bubble(text, me) {
  const chatLog = document.getElementById('chatLog');
  if (!chatLog) return null;
  const d = document.createElement('div');
  d.className = 'max-w-[85%] rounded-2xl px-4 py-2.5 leading-relaxed whitespace-pre-wrap ' + (me ? 'ml-auto bg-brand text-white' : '');
  if (!me) d.style.background = 'rgba(15,118,110,.1)';
  d.textContent = text; chatLog.appendChild(d); chatLog.scrollTop = chatLog.scrollHeight; return d;
}
function localAnswer(t) {
  t = t.toLowerCase(); let best = null, sc = 0;
  FAQ.forEach(f => { const n = f.k.filter(k => t.includes(k)).length; if (n > sc) { sc = n; best = f; } });
  return best ? best.a : 'Maaf, saya belum punya jawaban untuk itu. Silakan hubungi tim kami lewat tombol Minta Demo atau WhatsApp 087774487198.';
}
async function ask(text) {
  text = (text || '').trim(); if (!text) return;
  const chatChips = document.getElementById('chatChips');
  const chatLog = document.getElementById('chatLog');
  const chatInput = document.getElementById('chatInput');
  const chatSend = document.getElementById('chatSend');
  if (chatChips) chatChips.classList.add('hidden');
  bubble(text, true); if (chatInput) chatInput.value = '';
  const b = bubble('…', false); if (chatSend) chatSend.disabled = true;
  const KB = FAQ.map(f => `T: ${f.q}\nJ: ${f.a}`).join('\n\n');
  let out = null;
  try {
    const sample = await sampleP;
    if (sample) {
      const hist = chatHist.slice(-6).map(m => (m.me ? 'Pengguna: ' : 'Asisten: ') + m.t).join('\n');
      const prompt = `Kamu adalah asisten FAQ untuk MySehat, platform manajemen rumah sakit. Jawab dalam bahasa Indonesia, singkat (maksimal 4 kalimat), ramah, dan hanya berdasarkan basis pengetahuan di bawah. Jika jawabannya tidak ada, katakan belum tahu dan arahkan ke tombol Minta Demo atau WhatsApp 087774487198. Jangan memberi diagnosis medis.\n\nBASIS PENGETAHUAN:\n${KB}\n\nRIWAYAT:\n${hist}\n\nPertanyaan pengguna: ${text}`;
      const r = await sample(prompt, {cache: false, onText: ({text: t}) => { if (b) { b.textContent = t; chatLog.scrollTop = chatLog.scrollHeight; } }});
      out = r && r.text;
    }
  } catch (e) { out = null; }
  if (!out) out = localAnswer(text);
  if (b) b.textContent = out;
  chatHist.push({me: true, t: text}, {me: false, t: out});
  if (chatSend) chatSend.disabled = false;
  if (chatLog) chatLog.scrollTop = chatLog.scrollHeight;
}
(function initChat(){
  const chatBtn = document.getElementById('chatBtn');
  const chatPanel = document.getElementById('chatPanel');
  const chatClose = document.getElementById('chatClose');
  const chatSend = document.getElementById('chatSend');
  const chatInput = document.getElementById('chatInput');
  const chatChips = document.getElementById('chatChips');
  if (!chatBtn || !chatPanel) return;
  bubble('Halo! Saya asisten MySehat. Ada yang ingin Anda tanyakan?', false);
  ['Apa itu MySehat?', 'Fitur apa saja?', 'Cara membeli produk', 'Bagaimana meminta demo?'].forEach(q => {
    const c = document.createElement('button'); c.textContent = q; c.className = 'card rounded-full px-3 py-1.5 text-xs hover:shadow'; c.onclick = () => ask(q); if (chatChips) chatChips.appendChild(c);
  });
  chatBtn.onclick = () => { chatPanel.classList.toggle('hidden'); chatPanel.classList.toggle('flex'); if (!chatPanel.classList.contains('hidden') && chatInput) chatInput.focus(); };
  if (chatClose) chatClose.onclick = () => { chatPanel.classList.add('hidden'); chatPanel.classList.remove('flex'); };
  if (chatSend) chatSend.onclick = () => ask(chatInput.value);
  if (chatInput) chatInput.onkeydown = e => { if (e.key === 'Enter') ask(chatInput.value); };
})();
</script>

@stack('scripts')
</body>
</html>
