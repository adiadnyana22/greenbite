@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <section class="h-screen w-screen">
        <div class="container mx-auto h-full flex flex-col justify-center items-center">
            <img src="{{ asset('assets/user/images/successIcon.png') }}" alt="Success" class="w-48 mb-8">
            <h1 class="text-2xl font-bold mb-2 text-center">Yeay, pemesanan makanan berhasil!</h1>
            <p class="py-1 text-center">
                Silahkan datang ke merchant yang anda pilih di waktu pengambilan yang sudah ditentukan
            </p>
            <a href="{{ route('home') }}" class="bg-primary rounded-full py-2 px-8 text-white mt-8 mb-2 border border-primary transition hover:bg-transparent hover:text-primary">Kembali ke beranda</a>
        </div>
    </section>
@endsection

@section('footExtention')
    
@endsection
