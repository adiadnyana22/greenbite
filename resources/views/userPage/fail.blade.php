@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <section class="h-screen w-screen">
        <div class="container mx-auto h-full flex flex-col justify-center items-center">
            <i class='bx bx-message-alt-x text-red-500 text-[200px] mb-8'></i>
            <h1 class="text-2xl font-bold mb-2">Terjadi kesalahan</h1>
            <p class="py-1">
                Transaksi anda gagal dilakukan, silahkan coba lagi
            </p>
            <a href="{{ route('home') }}" class="bg-primary rounded-full py-2 px-8 text-white mt-8 mb-2 border border-primary transition hover:bg-transparent hover:text-primary">Kembali ke beranda</a>
        </div>
    </section>
@endsection

@section('footExtention')
    
@endsection
