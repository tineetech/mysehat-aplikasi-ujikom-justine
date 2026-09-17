@extends('layouts.main')

@section('content')

    <section class="py-10 px-10 flex justify-center flex-col ">
        <div class="">
            <h1 class="text-center text-3xl">Jelajahi <strong>Galery</strong> Kami.</h1>
        </div>
        
        <div class=" gap-4 grid grid-cols-3 px-20 mt-10 pb-20">

            @foreach($galery as $g)
            <div class=" bg-white rounded-md shadow overflow-hidden">
                <img src="{{ asset('storage/' . $g->file_path) }}" class="w-full m-0 h-50 object-cover" alt="produk">
                
            </div>
            @endforeach

        </div>

    </section>
    
@endsection