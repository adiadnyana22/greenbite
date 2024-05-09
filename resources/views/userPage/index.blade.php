@extends('userComponent.default')

@section('title', 'GreenBite')

@section('content')
    <!-- Banner -->
    <section class="pt-[150px] pb-16 box-border bg-tertiary h-screen">
        <div class="container mx-auto h-full">
            <div class="flex gap-8 justify-between items-center h-full">
                <div>
                    <!-- <span class="font-light text-lg">GreenBite</span> -->
                    <h1 class="font-bold text-7xl leading-tight py-2">Bersama Kurangi<br><span class="text-primary">Food Waste<span></h1>
                    <p class="mb-6">
                        Mulai dari diri sendiri, untuk dunia yang lebih baik
                    </p>
                    <a href="{{ route('foodList') }}" class="text-white bg-secondary rounded-lg px-8 py-2 mt-2 mb-4 inline-block borer border-secondary">Lihat Makanan di Sekitar</a>
                </div>
                <div class="place-self-center">
                    <div id="map" class="w-[600px] h-[450px] rounded-lg shadow-lg"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Makanan Terdekat -->
    <section class="py-12">
        <div class="container mx-auto">
            <div class="flex gap-2 justify-between items-end">
                <div>
                    <h2 class="text-center font-bold text-3xl mt-4">Makanan Terdekat</h2>
                </div>
                <a href="{{ route('foodList') }}" class="flex items-center gap-1 transition hover:text-primary">Lihat lebih banyak <i class='bx bx-chevron-right text-lg' ></i></a>
            </div>
           
            <div class="grid grid-cols-4 gap-4 my-8" id="foodList">
                <!-- By API -->
            </div>
            <svg class="animate-spin -ml-1 mr-3 h-12 w-12 text-black flex items-center w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" id="loading">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </section>

    <!-- Kategori -->
    <section class="py-12">
        <div class="container mx-auto">
            <h2 class="text-center text-3xl font-bold mb-8">Kategori</h2>
            <div class="flex justify-center items-center gap-6 mb-12">
                <a href="{{ route('foodList', ['category' => 1]) }}" class="relative rounded-lg shadow-lg">
                    <img src="{{ asset('assets/user/images/food/11.jpeg') }}" alt="Pastry" class="h-48 w-48 object-cover rounded-lg">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75 rounded-lg"></div>
                    <div class="absolute bottom-0 left-0 px-3 py-2 text-white text-2xl font-medium">Roti & Kue</div>
                </a>
                <a href="{{ route('foodList', ['category' => 2]) }}" class="relative rounded-lg shadow-lg">
                    <img src="{{ asset('assets/user/images/food/21.jpeg') }}" alt="Makanan Berat" class="h-48 w-48 object-cover rounded-lg">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75 rounded-lg"></div>
                    <div class="absolute bottom-0 left-0 px-3 py-2 text-white text-2xl font-medium">Makanan Berat</div>
                </a>
                <a href="{{ route('foodList', ['category' => 3]) }}" class="relative rounded-lg shadow-lg">
                    <img src="{{ asset('assets/user/images/food/31.jpeg') }}" alt="Sayur" class="h-48 w-48 object-cover rounded-lg">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75 rounded-lg"></div>
                    <div class="absolute bottom-0 left-0 px-3 py-2 text-white text-2xl font-medium">Sayur</div>
                </a>
                <a href="{{ route('foodList', ['category' => 4]) }}" class="relative rounded-lg shadow-lg">
                    <img src="{{ asset('assets/user/images/food/41.jpeg') }}" alt="Daging" class="h-48 w-48 object-cover rounded-lg">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75 rounded-lg"></div>
                    <div class="absolute bottom-0 left-0 px-3 py-2 text-white text-2xl font-medium">Daging</div>
                </a>
            </div>
        </div>
    </section>

    <!-- Informasi -->
    <section class="py-12">
        <div class="container mx-auto">
            <div class="rounded-lg bg-tertiary flex justify-between items-center gap-24 px-12 py-10 shadow-lg">
                <div class="grow w-3/4">
                    <img src="{{ asset('assets/user/images/info.png') }}" alt="Informasi">
                </div>
                <div class="grow w-full">
                    <h2 class="text-3xl font-bold text-primary">Pemanfaatan makanan secara menyeluruh dapat berdampak besar bagi dunia</h2>
                    <ul class="flex flex-col gap-3 mt-8">
                        <li class="flex justify-start items-center gap-3">
                            <i class='bx bxs-hot text-3xl text-secondary'></i>
                            Mengurangi penambahan pemanasan global
                        </li>
                        <li class="flex justify-start items-center gap-3">
                            <i class='bx bxs-wallet-alt text-3xl text-secondary'></i>
                            Mengurangi kerugian secara ekonomi
                        </li>
                        <li class="flex justify-start items-center gap-3">
                            <i class='bx bxs-baguette text-3xl text-secondary' ></i>
                            Mengurangi kerugian potensi makanan untuk orang lain
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel -->
    <section class="py-12">
        <div class="container mx-auto">
            <div class="flex gap-2 justify-between items-end">
                <div>
                    <h2 class="font-bold text-3xl mt-4">Artikel Terbaru</h2>
                    <p class="text-gray-500 text-sm">Pembahasan seputar food waste dan pemanfaatan makanan</p>
                </div>
                <a href="{{ route('newsList') }}" class="flex items-center gap-1 transition hover:text-primary">Lihat lebih banyak <i class='bx bx-chevron-right text-lg' ></i></a>
            </div>
            <div class="grid grid-cols-3 gap-4 my-8">
                @foreach ($newsList as $news)
                <a href="{{ route('newsDetail', $news->id) }}">
                    <img src="{{ asset('assets/user/images/news/'.$news->image) }}" alt="Artikel" class="h-48 w-full object-cover rounded-lg">
                    <h3 class="text-xl my-2">{{ $news->title }}</h3>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-12">
        <div class="container mx-auto">
            <h2 class="text-center text-3xl font-bold mb-8">Frequently Ask Question</h2>
            <ul class="w-[900px] max-w-full mx-auto">
                <li x-data="{ open: false }" class="mb-4">
                    <div class="cursor-pointer flex justify-between items-center px-8 py-4 rounded-lg border border-gray/25" @click="open = ! open">
                        <div class="text-xl">Apa itu GreeBite?</div>
                        <div class="text-2xl"><i class="bx bx-chevron-down"></i></div>
                    </div>
                    <p class="px-8 py-4 text-gray-500" x-show="open" style="display: none;">
                        GreenBite adalah aplikasi jual beli makanan berlebih yang memungkinkan mitra GreenBite untuk menjual makanan yang tidak habis terjual dan pengguna dapat membelinya di merchant terdekat dengan harga yang terjangkau
                    </p>
                </li>
                <li x-data="{ open: false }" class="mb-4">
                    <div class="cursor-pointer flex justify-between items-center px-8 py-4 rounded-lg border border-gray/25" @click="open = ! open">
                        <div class="text-xl">Apa saja yang saya dapatkan jika membeli makanan?</div>
                        <div class="text-2xl"><i class="bx bx-chevron-down"></i></div>
                    </div>
                    <p class="px-8 py-4 text-gray-500" x-show="open" style="display: none;">
                        Makanan yang didapatkan sangat tergantung pada penawaran setiap merchant, akan ada kategorisasi makanan yang bisa dipilih dan judul makanan akan merepresentasikan isi dari paket makanan yang akan anda terima
                    </p>
                </li>
                <li x-data="{ open: false }" class="mb-4">
                    <div class="cursor-pointer flex justify-between items-center px-8 py-4 rounded-lg border border-gray/25" @click="open = ! open">
                        <div class="text-xl">Bagaimana cara saya melakukan pemesanan?</div>
                        <div class="text-2xl"><i class="bx bx-chevron-down"></i></div>
                    </div>
                    <p class="px-8 py-4 text-gray-500" x-show="open" style="display: none;">
                        Anda bisa melakukan registrasi dan login akun GreenBite terlebih dahulu, kemudian memilih dan memesan makanan yang ingin dibeli sampai berhasil melakukan pembayaran, dan akhirnya makanan tersebut dapat diambil langsung di merchat pilihan anda pada jam yang sudah ditentukan
                    </p>
                </li>
            </ul>
        </div>
    </section>
@endsection

@section('footExtention')
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyBFCavjPZcDlfq93MQMbnzlu_a4Q5pnXi0",
            v: "weekly",
            // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
            // Add other bootstrap parameters as needed, using camel case.
        });
    </script>
    <script>
        let map;

        async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

            map = new Map(document.getElementById("map"), {
                center: { lat: -6.177807389949748, lng: 106.8236927647547 },
                zoom: 10,
                disableDefaultUI: true,
                mapId: "DEMO_MAP_ID",
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async function(position) {
                    const marker = new AdvancedMarkerElement({
                        map: map,
                        position: {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        },
                        title: 'Your Position'
                    });
                    map.setCenter({
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    });
                    map.setZoom(14);

                    document.cookie = 'latitude=' + position.coords.latitude;
                    document.cookie = 'longitude=' + position.coords.longitude;

                    const response = await fetch('{{ route('foodHomeAPI') }}');
                    const foodList = await response.json();
                    
                    const foodListContainer = document.querySelector("#foodList");
                    const loading = document.querySelector("#loading").remove();

                    foodList.forEach((food) => {
                        foodListContainer.insertAdjacentHTML('beforeend', 
                            `<a href="/food/${food.id}" class="rounded-lg shadow-lg">
                                <div class="relative h-32 w-full">
                                    <img src="assets/user/images/food/${food.food_category_id}${(food.id % 4 + 1)}.jpeg" alt="Food" class="object-cover h-32 w-full rounded-t-lg z-0">
                                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75"></div>
                                    <div class="absolute top-0 left-0 p-2 w-full flex justify-between items-center">
                                        <div class="${food.stock != 0 ? 'bg-primary' : 'bg-gray-500'} px-3 py-1 rounded font-medium text-white">${food.stock} left</div>
                                    </div>
                                    <h3 class="absolute left-2 bottom-2 text-white text-2xl p-1 font-medium">${food.name}</h3>
                                </div>
                                <div class="px-3 py-2">
                                    <div class="flex justify-start items-center gap-4 mt-1">
                                        <img src="assets/user/images/merchant/${food.mitra.logo}" alt="Merchant"  class="rounded-full h-12 w-12 object-contain border-2 border-primary">
                                        <div class="pr-4">
                                            <h4 class="text-sm leading-none font-bold">${food.mitra.name}</h4>
                                            <p class="text-xs text-gray-500">${calculateDistance(position.coords.latitude, position.coords.longitude, food.mitra.latitude, food.mitra.longitude).toFixed(2)} km</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <p class="text-sm text-gray-500">Pickup time : ${food.start_pickup.substr(0, 5)} - ${food.end_pickup.substr(0, 5)}</p>
                                        <div class="text-gray-500 text-sm"><i class='bx bxs-star text-primary'></i> ${(food.order_count == 0) ? '-' : food.rating}</div>
                                    </div>
                                    <div class="flex items-center mt-3 mb-1 bg-tertiary border border-primary rounded-lg px-3 py-1">
                                        <span class="font-medium">Rp</span>
                                        <div class="grow flex justify-end items-center gap-2">
                                            <div class="line-through text-gray-500 text-sm mt-1">${new Intl.NumberFormat('en-US').format(food.normal_price)}</div>
                                            <div class="text-lg font-medium">${new Intl.NumberFormat('en-US').format(food.current_price)}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>`
                        );
                    });
                },
                (error) => {
                    document.cookie = 'latitude=-6.177807389949748';
                    document.cookie = 'longitude=106.8236927647547';
                });
            } else { 
                document.cookie = 'latitude=-6.177807389949748';
                document.cookie = 'longitude=106.8236927647547';
            }
            
        }

        function calculateDistance(lat1, lon1, lat2, lon2){
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

        initMap();
    </script>
@endsection