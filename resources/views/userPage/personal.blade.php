@extends('userComponent.default')

@section('title', 'GreenBite')

@section('content')
    <!-- News Detail -->
    <section class="pt-[125px] md:pt-[150px] lg:pt-[175px] pb-16">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row gap-8 my-3 items-start">
                <ul class="sticky flex flex-row md:flex-col px-1 md:px-8 gap-2 md:gap-6 w-full md:w-80">
                    <li class="w-full"><a href="{{ route('profile') }}" class="text-white text-lg bg-primary block px-4 py-2 rounded transition hover:bg-primary hover:text-white">Personal Info</a></li>
                    <hr>
                    <li class="w-full"><a href="{{ route('voucher') }}" class="text-gray-400 text-lg bg-gray-100 block px-4 py-2 rounded transition hover:bg-primary hover:text-white">Voucher</a></li>
                </ul>
                <div class="w-full">
                    <h1 class="text-3xl font-bold mb-4">Personal Info</h1>
                    <form action="{{ route('profileMtd') }}" class="shadow-lg rounded-lg px-12 py-8" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="name" class="block mb-4">Name
                            <input type="text" id="name" name="name" placeholder="Enter your name ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                        </label>
                        <label for="email" class="block mb-4">Email
                            <input type="email" id="email" name="email" placeholder="Enter your email ..." class="block w-full bg-gray-300 rounded-lg px-6 py-3 mt-1 text-gray-500" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" disabled>
                        </label>
                        <label for="password" class="block mb-4">Password <span class="font-bold text-gray-400 text-sm">(Kosongkan jika password tidak ingin diganti)</span>
                            <input type="password" id="password" name="password" placeholder="Enter your password ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                            @error('password')<p class="py-2 text-red-500">{{ $message }}</p>@enderror
                        </label>
                        <label for="confirm_password" class="block mb-4">Confirm Password <span class="font-bold text-gray-400 text-sm">(Kosongkan jika password tidak ingin diganti)</span>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your password again ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                        </label>
                        <button class="block w-full bg-primary text-white rounded-lg px-6 py-3 font-bold tracking-wider my-6">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    
@endsection