@extends('userComponent.default')

@section('title', 'GreenBite')

@section('headExtention')
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection

@section('content')
    <!-- News -->
    <section class="pt-[175px] pb-16">
        <div class="container mx-auto">
            <div class="flex items-start gap-12" x-data="data()">
                <div class="basis-3/5">
                    <div class="relative">
                        <img src="{{ asset('assets/user/images/food/'.$food->food_category_id.($food->id % 4 + 1).'.jpeg') }}" alt="{{ $food->name }}" class="w-full h-96 object-cover rounded-lg">
                        <div class="bg-primary px-4 py-2 rounded absolute top-4 right-4 text-white text-lg font-medium">{{ $food->category->name }}</div>
                    </div>
                    <div class="flex justify-between items-center">
                        <h1 class="text-4xl font-bold py-4">{{ $food->name }}</h1>
                        <a href="{{ route('wishlistToggle', $food->id) }}" class="flex items-center gap-2 text-sm"> <i class="bx {{ $wishlist ? 'bxs-heart text-red-500' : 'bx-heart text-gray' }} text-2xl"></i> {{ $wishlist ? '-' : '+' }} wishlist </a>
                    </div>
                    <ul class="flex flex-col gap-1">
                        <li class="flex justify-between items-center text-gray-500">
                            <div>Stok</div>
                            <div>{{ $food->stock }}</div>
                        </li>
                        <hr>
                        <li class="flex justify-between items-center text-gray-500">
                            <div>Perkiraan jumlah makanan</div>
                            <div>{{ $food->min_qty }}{{ $food->min_qty != $food->max_qty ? " - ".$food->max_qty : "" }}</div>
                        </li>
                        <hr>
                        <li class="flex justify-between items-center text-gray-500">
                            <div>Baik dimakan sebelum</div>
                            <div>{{ Carbon\Carbon::now()->addDays($food->day_to_expiration)->format('d/m/Y') }}</div>
                        </li>
                        <hr>
                    </ul>
                    <div class="rounded-lg shadow-lg bg-tertiary px-8 py-6 flex justify-between items-center gap-8 my-8">
                        <img src="{{ asset('assets/user/images/info.png') }}" alt="Info" class="w-24 object-cover">
                        <p class="text-sm text-gray-500 text-justify leading-relaxed">
                            Makanan yang ada disini adalah makanan yang tidak habis terjual oleh merchant, jadi anda tidak bisa memilih makanan apa yang akan anda terima. Walaupun begitu, tetap dipastikan makanan tersebut masih dalam kategori yang sesuai
                        </p>
                    </div>
                    <div class="flex justify-start items-center gap-4 my-8">
                        <img src="{{ asset('assets/user/images/merchant/'.$food->mitra->logo) }}" alt="Mitra"  class="rounded-full h-14 w-14 object-contain border-2 border-primary">
                        <div>
                            <h4 class="text-xl font-bold">{{ $food->mitra->name }}</h4>
                            <p class="text-sm text-gray-500 -mt-1" x-text="calculateDistance(getCookie('latitude'), getCookie('longitude'), {{ $food->mitra->latitude }}, {{ $food->mitra->longitude }}).toFixed(2) + ' km'"> km</p>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mt-12">
                            <h2 class="text-2xl font-semibold">Ulasan Makanan</h2>
                            <div class="text-xl">
                                <i class='bx bxs-star text-coin' ></i>
                                {{ ($food->order_count == 0) ? '-' : $food->rating }} <span class="text-gray">({{ count($food->review) }} reviews)</span>
                            </div>
                        </div>
                        <ul class="my-5 flex flex-col gap-3">
                            @foreach($food->review as $review)
                                @if ($review->comment)
                                <li  class="px-8 py-4 border borer-gray/25 rounded-lg">
                                    <div class="flex justify-between">
                                        <div class="font-bold mb-2">{{ $review->user->name }}</div>
                                        <div><i class='bx bxs-star text-coin' ></i> {{ $review->rating }}</div>
                                    </div>
                                    <div>{{ $review->comment }}</div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form action="{{ route('foodDetailMtd', $food->id) }}" method="POST" class="basis-2/5 sticky top-[150px]" x-data="{ count: 1 }">
                    @csrf
                    @method('POST')
                    <div class="px-8 py-4 rounded-lg shadow-lg">
                        <h2 class="text-3xl font-bold">Pemesanan</h2>
                        <div class="flex justify-between flex-wrap items-center my-8">
                            <label for="#">Jumlah Pesanan</label>
                            <div class="flex items-center gap-2">
                                <button type="button" class="py-1 px-3 bg-black rounded text-white text-xl transition hover:bg-black/75" x-on:click="count = Math.max(count - 1, 1)">-</button>
                                <input type="number" x-model="count" name="qty" class="w-12 text-center outline-none text-xl">
                                <button type="button" class="py-1 px-3 bg-black rounded text-white text-xl transition hover:bg-black/75" x-on:click="count = Math.min(count + 1, {{ $food->stock == 0 ? 1 : $food->stock }})">+</button>
                            </div>
                        </div>
                        <div>
                            <div class="text-lg font-semibold mb-1 mt-4">Alamat Pengambilan</div>
                            <address class="text-sm">{{ $food->mitra->address }}</address>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $food->mitra->latitude }}%2C{{ $food->mitra->longitude }}" target="_blank" class="text-sm text-gray-400 underline"><i class='bx bxs-map'></i> Open Google Maps</a>
                        </div>
                        <divc class="flex justify-between items-center">
                            <div class="text-lg font-semibold mb-1 mt-4">Pickup Time</div>
                            <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $food->start_pickup)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $food->end_pickup)->format('H:i') }}</p>
                        </divc>
                        <div class="py-5 flex justify-between items-center">
                            <div class="text-gray-400 text-xl font-bold">TOTAL HARGA</div>
                            <strong class="font-bold text-2xl">Rp <span x-text="new Intl.NumberFormat('en-US').format(count * {{ $food->current_price }})"></span></strong>
                        </div>
                        @if ($food->stock == 0)
                            <div class="text-center w-full px-4 py-3 mt-2 mb-2 rounded-lg bg-gray-500 text-white">Stok Habis</div>
                        @elseif (Carbon\Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::today()->toDateString().' '.$food->end_pickup)->lt(\Carbon\Carbon::now()))
                            <div class="text-center w-full px-4 py-3 mt-2 mb-2 rounded-lg bg-gray-500 text-white">Jam Pickup Sudah Lewat</div>
                        @else
                            <button class="block text-center w-full px-4 py-3 mt-2 mb-2 rounded-lg bg-secondary text-white transition border border-secondary hover:bg-transparent hover:text-secondary">Pesan Sekarang</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection

@section('footExtention')
    <script>
        function data() {
            return {
                calculateDistance(lat1, lon1, lat2, lon2){
                    var R = 6371; // km
                    var dLat = (lat2-lat1) * Math.PI / 180;
                    var dLon = (lon2-lon1) * Math.PI / 180;
                    var lat1 = (lat1) * Math.PI / 180;
                    var lat2 = (lat2) * Math.PI / 180;

                    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                    var d = R * c;

                    return d;
                },
                getCookie(name) {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; ${name}=`);
                    if (parts.length === 2) return parts.pop().split(';').shift();
                }
            }
        }
    </script>
@endsection