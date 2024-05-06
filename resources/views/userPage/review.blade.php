@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <section class="h-screen w-screen bg-[#F4F4F4]">
        <div class="h-screen max-w-full w-[700px] mx-auto pl-24 pt-12 pr-16 pb-16 overflow-auto" x-data="{ isTaCChecked: false }">
            <form action="{{ route('reviewMtd') }}" method="POST" x-data="{ star : 0 }">
                @csrf
                @method('POST')
                <div class="mt-6 mb-4">
                    <h1 class="text-3xl font-bold">Review Makanan</h1>
                </div>
                <div class="bg-white rounded-lg shadow mb-5 px-6 py-4">
                    <div class="flex gap-3 text-4xl mt-2 mb-6 ml-1" x-data="{ starHover: 0 }">
                        <label>
                            <input class="sr-only peer" name="rating" type="radio" value="1" x-model="star" />
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400" x-bind:class="(star >= 1 || starHover >= 1) ? 'text-coin' : ''" x-on:mouseenter="starHover = 1" x-on:mouseleave="starHover = 0">
                                <i class='bx bxs-star' ></i>
                            </div>
                        </label>
                        <label>
                            <input class="sr-only peer" name="rating" type="radio" value="2" x-model="star" />
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400" x-bind:class="(star >= 2 || starHover >= 2) ? 'text-coin' : ''" x-on:mouseenter="starHover = 2" x-on:mouseleave="starHover = 0">
                                <i class='bx bxs-star' ></i>
                            </div>
                        </label>
                        <label>
                            <input class="sr-only peer" name="rating" type="radio" value="3" x-model="star" />
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400" x-bind:class="(star >= 3 || starHover >= 3) ? 'text-coin' : ''" x-on:mouseenter="starHover = 3" x-on:mouseleave="starHover = 0">
                                <i class='bx bxs-star' ></i>
                            </div>
                        </label>
                        <label>
                            <input class="sr-only peer" name="rating" type="radio" value="4" x-model="star" />
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400" x-bind:class="(star >= 4 || starHover >= 4) ? 'text-coin' : ''" x-on:mouseenter="starHover = 4" x-on:mouseleave="starHover = 0">
                                <i class='bx bxs-star' ></i>
                            </div>
                        </label>
                        <label>
                            <input class="sr-only peer" name="rating" type="radio" value="5" x-model="star" />
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400" x-bind:class="(star >= 5 || starHover >= 5) ? 'text-coin' : ''" x-on:mouseenter="starHover = 5" x-on:mouseleave="starHover = 0">
                                <i class='bx bxs-star' ></i>
                            </div>
                        </label>
                    </div>
                    <textarea name="review" id="review" cols="30" rows="5" placeholder="Tulis reviewmu disini!" class="w-full border border-gray/25 rounded-lg px-4 py-3"></textarea>
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button class="rounded bg-primary px-4 py-3 text-center text-white block w-full mb-2 mt-4 border border-primary transition hover:text-primary hover:bg-transparent">Kirim Review</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('footExtention')
    
@endsection