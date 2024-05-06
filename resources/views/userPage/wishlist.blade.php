@extends('userComponent.default')

@section('title', 'GreenBite')

@section('content')
    <!-- News -->
    <section class="pt-[200px] pb-16">
        <div class="container mx-auto">
            <div>
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-5xl font-bold">Wishlist</h1>
                </div>
                <div class="grid grid-cols-3 gap-4 my-8" x-data="data()">
                    @foreach ($wishlistList as $wishlist)
                    <a href="{{ route('foodDetail', $wishlist->food->id) }}" class="rounded-lg shadow-lg">
                        <div class="relative h-32 w-full">
                            <img src="{{ asset('assets/user/images/food/'.$wishlist->food->food_category_id.($wishlist->food->id % 4 + 1).'.jpeg') }}" alt="{{ $wishlist->food->name }}" class="object-cover h-32 w-full rounded-t-lg z-0">
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75"></div>
                            <div class="absolute top-0 left-0 p-2 w-full flex justify-between items-center">
                                <div class="bg-primary px-3 py-1 rounded font-medium text-white">{{ $wishlist->food->stock }} left</div>
                            </div>
                            <h3 class="absolute left-2 bottom-2 text-white text-2xl p-1 font-medium">{{ $wishlist->food->name }}</h3>
                        </div>
                        <div class="px-3 py-2">
                            <div class="flex justify-start items-center gap-4 mt-1">
                                <img src="{{ asset('assets/user/images/merchant/'.$wishlist->food->mitra->logo) }}" alt="Dunkin"  class="rounded-full h-12 w-12 object-contain border-2 border-primary">
                                <div class="pr-4">
                                    <h4 class="text-base leading-none font-bold">{{ $wishlist->food->mitra->name }}</h4>
                                    <p class="text-sm text-gray-500" x-text="calculateDistance(document.cookie.split('; ').find((row) => row.startsWith('latitude='))?.split('=')[1], document.cookie.split('; ').find((row) => row.startsWith('longitude='))?.split('=')[1], {{ $wishlist->food->mitra->latitude }}, {{ $wishlist->food->mitra->longitude }}).toFixed(2) + ' km'"> km</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-sm text-gray-500">Pickup time : {{ \Carbon\Carbon::createFromFormat('H:i:s', $wishlist->food->start_pickup)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $wishlist->food->end_pickup)->format('H:i') }}</p>
                                <div class="text-gray-500 text-sm"><i class='bx bxs-star text-primary'></i> {{ ($wishlist->food->order_count == 0) ? '-' : $wishlist->food->rating }}</div>
                            </div>
                            <div class="flex items-center mt-3 mb-1 bg-tertiary border border-primary rounded-lg px-3 py-1">
                                <span class="font-medium">Rp</span>
                                <div class="grow flex justify-end items-center gap-2">
                                    <div class="line-through text-gray-500 text-sm mt-1">{{ number_format($wishlist->food->normal_price) }}</div>
                                    <div class="text-lg font-medium">{{ number_format($wishlist->food->current_price) }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
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
                }
            }
        }
    </script>
@endsection