@extends('userComponent.default')

@section('title', 'GreenBite')

@section('content')
    <!-- News Detail -->
    <section class="pt-[125px] md:pt-[150px] lg:pt-[175px] pb-16">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row gap-8 my-3 items-start">
                <ul class="sticky flex flex-row md:flex-col px-1 md:px-8 gap-2 md:gap-6 w-full md:w-80">
                    <li class="w-full"><a href="{{ route('profile') }}" class="text-gray-400 text-lg bg-gray-100 block px-4 py-2 rounded transition hover:bg-primary hover:text-white">Personal Info</a></li>
                    <hr>
                    <li class="w-full"><a href="{{ route('voucher') }}" class="text-white text-lg bg-primary block px-4 py-2 rounded transition hover:bg-primary hover:text-white">Voucher</a></li>
                </ul>
                <div class="w-full">
                    <h1 class="text-3xl font-bold mb-4">Voucher</h1>
                    <div class="shadow-lg rounded-lg px-12 py-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($voucherList as $voucher)
                        <div class="rounded-lg border border-gray/25 px-8 py-6 w-full flex items-center gap-8">
                            <i class="bx bx-purchase-tag text-4xl text-primary"></i>
                            <div>
                                <h2 class="text-xl mb-1 font-bold">{{ $voucher->name }}</h2>
                                <p class="text-gray-400 text-sm">{{ $voucher->description }}</p>
                                <p class="text-gray-400 text-sm">min Rp {{ number_format($voucher->min_order_nominal) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection