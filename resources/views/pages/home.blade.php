@extends('layouts.main')

@section('content')

    <section class="py-10  px-10 bg-gray-700 h-screen flex items-center justify-between">
        <div class="text-white">
            <h1 class="text-6xl mb-5">Mulai Kelola Semua Dengan MySehat<span class="text-red-700">.</span></h1>
            
            <button onclick="window.location.href = '{{ route('filament.admin.pages.dashboard') }}'" class="btn px-5 py-2 bg-red-600 text-white cursor-pointer rounded">Mulai Sekarang <i class=""></i></button>
        </div>
        
        <div class="w-[90%]">
            <img class="rounded-2xl w-full" src="{{ asset('assets/img/preview-sistem.png') }}" alt="">
        </div>
    </section>
    
@endsection