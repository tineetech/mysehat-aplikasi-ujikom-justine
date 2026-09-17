@extends('layouts.main')

@section('content')

    <section class="py-10 px-10 flex justify-center flex-col ">
        <div class="">
            <h1 class="text-center text-3xl">Jelajahi <strong>Produk</strong> Kesehatan Kami.</h1>
        </div>
        
        <div class=" gap-4 grid grid-cols-3 px-20 mt-10 pb-20">

            @foreach($produk as $p)
            <div class=" bg-white rounded-md shadow overflow-hidden">
                <img src="{{ asset('storage/' . $p->gambar) }}" class="w-full m-0 h-50 object-cover" alt="produk">
                <div class="p-3">
                    <h1 class="m-0 font-bold">{{ $p->nama }}</h1>
                    <p class="text-sm">{{ $p->deskripsi ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, in.' }}</p>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-red-500">Rp {{ number_format($p->harga) }}</p>
                        <a href="https://wa.me/6287774487198?text=Saya Mau Produk {{ $p->nama }}" class="btn bg-blue-500 text-white rounded px-3 py-1">Beli Sekarang</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </section>
    
@endsection