<!-- CHATBOT -->
<div class="fixed right-4 z-50 flex flex-col items-end" style="bottom:calc(1rem + env(safe-area-inset-bottom,0px))">
  <div id="chatPanel" class="hidden card rounded-3xl shadow-2xl w-[calc(100vw-2rem)] sm:w-96 mb-3 overflow-hidden flex-col" style="height:min(32rem,72vh)">
    <div class="bg-brand text-white px-4 py-3 flex items-center gap-3"><span class="w-9 h-9 rounded-full bg-white/20 grid place-items-center"><i class="fa-solid fa-robot"></i></span><div class="flex-1 leading-tight"><p class="font-semibold text-sm">Asisten MySehat</p><p class="text-[11px] opacity-80">Tanya seputar MySehat</p></div><button id="chatClose" aria-label="Tutup" class="w-8 h-8 rounded-full hover:bg-white/15"><i class="fa-solid fa-xmark"></i></button></div>
    <div id="chatLog" class="flex-1 overflow-y-auto p-4 space-y-3 text-sm"></div>
    <div id="chatChips" class="px-4 pb-2 flex flex-wrap gap-2"></div>
    <div class="p-3 border-t flex gap-2" style="border-color:var(--line)"><input id="chatInput" class="card rounded-full px-4 py-2 text-sm bg-transparent flex-1 min-w-0" placeholder="Tulis pertanyaan…" aria-label="Pertanyaan"><button id="chatSend" aria-label="Kirim" class="bg-brand hover:bg-brand-dark text-white w-10 h-10 rounded-full shrink-0"><i class="fa-solid fa-paper-plane"></i></button></div>
  </div>
  <button id="chatBtn" aria-label="Buka asisten MySehat" class="w-14 h-14 rounded-full bg-brand hover:bg-brand-dark text-white shadow-xl text-xl"><i class="fa-solid fa-comments"></i></button>
</div>
