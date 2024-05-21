@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <div class="min-h-screen w-screen grid grid-cols-1 lg:grid-cols-2 items-start">
        <section class="bg-tertiary shadow-lg flex justify-center items-center h-screen sticky top-0 hidden lg:flex">
            <img src="{{ asset('assets/user/images/auth.png') }}" alt="Login" class="w-5/6 mx-auto">
        </section>
        <section class="p-12 sm:p-24 pb-8">
            <h1 class="text-4xl font-light">Register <strong class="font-bold"><span class="text-primary">Green</span>Bite</strong></h1>
            <form action="{{ route('registerUserMtd') }}" class="mt-12" method="POST">
                @csrf
                @method('POST')
                <label for="name" class="block mb-4">Name :
                    <input type="text" id="name" name="name" placeholder="Enter your name ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                    @error('name')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                </label>
                <label for="email" class="block mb-4">Email :
                    <input type="email" id="email" name="email" placeholder="Enter your email ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                    @error('email')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                </label>
                <label for="password" class="block mb-4">Password :
                    <input type="password" id="password" name="password" placeholder="Enter your password ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                    @error('password')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                </label>
                <label for="confirm_password" class="block mb-4">Confirm Password :
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your password again ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                    @error('confirm_password')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                </label>
                <button class="block w-full bg-primary text-white rounded-lg px-6 py-3 font-bold tracking-wider my-12">Register</button>
            </form>
            <hr>
            <div class="text-center py-8">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary underline">Login</a></div>
        </section>
    </div>
@endsection