@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <div class="h-screen w-screen grid grid-cols-2">
        <section class="bg-tertiary shadow-lg flex justify-center items-center">
            <img src="{{ asset('assets/user/images/auth.png') }}" alt="Login" class="w-5/6 mx-auto">
        </section>
        <section class="p-24 pb-8">
            <h1 class="text-4xl font-light pb-6">Login <strong class="font-bold"><span class="text-primary">Green</span>Bite</strong></h1>
            @error('login')
            <p class="py-2 text-red-500 italic">{{ $message }}</p>
            @enderror
            <form action="{{ route('loginMtd') }}" class="pt-6" method="POST">
                @csrf
                @method('POST')
                <label for="email" class="block mb-8">Email :
                    <input type="email" id="email" name="email" placeholder="Enter your email ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                </label>
                <label for="password" class="block mb-8">Password :
                    <input type="password" id="password" name="password" placeholder="Enter your password ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                </label>
                <button class="block w-full bg-primary text-white rounded-lg px-6 py-3 font-bold tracking-wider my-12">Login</button>
            </form>
            <hr>
            <div class="text-center py-8">Belum punya akun? <a href="{{ route('registerUser') }}" class="text-primary underline">Register</a></div>
            <a href="{{ route('home') }}" class="text-gray-500 text-center py-2 block flex items-center justify-center gap-2 hover:text-black transition"><i class='bx bx-chevron-left'></i> Back to homepage</a>
        </section>
    </div>
@endsection