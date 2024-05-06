@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    @include('userComponent.header')

    <div class="w-screen bg-tertiary grid grid-cols-2">
        <div class="sticky top-0 h-screen">
            <div id="map" class="h-screen"></div>
        </div>
        <section class="px-12">
            <div class="sticky top-0 z-10 bg-tertiary pb-3 pt-[150px]">
                <h1 class="text-4xl font-bold mb-6">Food List</h1>
                <form action="" method="GET" id="form">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search by name" class="block w-full px-6 py-3 rounded-lg bg-white shadow" value="{{ $search }}">
                        <button class="absolute right-3 top-2 bg-primary rounded shadow w-8 h-8 font-bold text-white"><i class='bx bx-search'></i></button>
                    </div>
                    <div class="flex gap-4 justify-start items-center my-3">
                        <label for="" class="text-sm">Distance : 
                            <select name="distance" id="distance" class="px-4 py-1 rounded-lg bg-gray-100 shadow">
                                <option value="1" {{ $distance == 1 ? 'selected' : '' }}>1 Km</option>
                                <option value="2" {{ $distance == 2 ? 'selected' : '' }}>2 Km</option>
                                <option value="5" {{ $distance == 5 ? 'selected' : '' }}>5 Km</option>
                                <option value="10" {{ $distance == 10 ? 'selected' : '' }}>10 Km</option>
                                <option value="20" {{ $distance == 20 ? 'selected' : '' }}>20 Km</option>
                            </select>
                        </label>
                        <label for="" class="text-sm">Category : 
                            <select name="category" id="category" class="px-4 py-1 rounded-lg bg-gray-100 shadow">
                                @foreach ($categoryList as $categoryDetail)
                                    <option value="{{ $categoryDetail->id }}" {{ $category == $categoryDetail->id ? 'selected' : '' }}>{{ $categoryDetail->name }}</option>    
                                @endforeach
                                <option value="all" {{ $category == 'all' ? 'selected' : '' }}>All</option>
                            </select>
                        </label>
                    </div>
                </form>
            </div>
            <div class="mt-3 mb-12 flex flex-col gap-4" x-data="data()">
                @foreach ($foodList as $food)
                <a href="{{ route('foodDetail', $food->id) }}" class="bg-secondary rounded-lg">
                    <div class="flex bg-white rounded-lg shadow bg-white w-full">
                        <div class="w-48 relative">
                            <img src="{{ asset('assets/user/images/food/'.$food->food_category_id.($food->id % 4 + 1).'.jpeg') }}" alt="{{ $food->name }}" class="object-cover w-48 h-full rounded-lg">
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/75 rounded-lg"></div>
                            <div class="absolute top-0 left-0 p-2 w-full flex justify-between items-center">
                                <div class="{{ $food->stock != 0 ? 'bg-primary' : 'bg-gray-500' }} px-3 py-1 rounded font-medium text-white text-sm">{{ $food->stock }} left</div>
                            </div>
                        </div>
                        <div class="px-4 py-2 flex flex-col justify-between h-full w-full">
                            <h3 class="text-2xl py-2 font-medium">{{ $food->name }}</h3>
                            <div class="flex justify-start items-center gap-4">
                                <img src="{{ asset('assets/user/images/merchant/'.$food->mitra->logo) }}" alt="Merchant"  class="rounded-full h-8 w-8 object-contain border-2 border-primary">
                                <div class="pr-4">
                                    <h4 class="font-bold leading-none text-sm">{{ $food->mitra->name }}</h4>
                                    <p class="text-xs text-gray-500" x-text="calculateDistance(getCookie('latitude'), getCookie('longitude'), {{ $food->mitra->latitude }}, {{ $food->mitra->longitude }}).toFixed(2) + ' km'"> km</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-2 w-full mb-2">
                                <p class="text-sm text-gray-500">Pickup time : {{ \Carbon\Carbon::createFromFormat('H:i:s', $food->start_pickup)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $food->end_pickup)->format('H:i') }}</p>
                                <div class="text-gray-500 text-sm"><i class='bx bxs-star text-primary'></i> {{ ($food->order_count == 0) ? '-' : $food->rating }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center bg-secondary text-white rounded-b-lg px-3 py-1">
                        <span class="font-medium">Rp</span>
                        <div class="grow flex justify-end items-center gap-2">
                            <div class="line-through text-gray-400 text-sm mt-1">{{ number_format($food->normal_price) }}</div>
                            <div class="text-lg font-medium">{{ number_format($food->current_price) }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@section('footExtention')
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyBFCavjPZcDlfq93MQMbnzlu_a4Q5pnXi0",
            v: "beta",
            solutionChannel: "GMP_CCS_datalayersinfo_v2",
        });
    </script>
    <script>
        /**
         * @license
         * Copyright 2024 Google LLC. All Rights Reserved.
         * SPDX-License-Identifier: Apache-2.0
         */
        let map;

        async function init() {
            const {InfoWindow} = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: { lat: -7, lng: 108 },
                disableDefaultUI: true,
                clickableIcons: false,
                mapId: "DEMO_MAP_ID",
            });

            const currLat = parseFloat(getCookie('latitude'));
            const currLng = parseFloat(getCookie('longitude'));

            const homeMapIcon = document.createElement('img');
            homeMapIcon.src = "{{ asset('assets/user/images/mapIcon.png') }}";
            homeMapIcon.width = '25';

            const marker = new AdvancedMarkerElement({
                map: map,
                position: {
                    lat: currLat,
                    lng: currLng,
                },
                content: homeMapIcon,
                title: 'Your Position',
                zIndex: 10,
            });
            map.setCenter({
                lat: currLat,
                lng: currLng,
            });

            @php
                if($distance == 1) $zoom = 15;
                if($distance == 2) $zoom = 14;
                if($distance == 5) $zoom = 13;
                if($distance == 10) $zoom = 12;
                if($distance == 20) $zoom = 11;
            @endphp

            map.setZoom({{ $zoom }});

            const response = await fetch('{{ route('foodMapAPI') }}' + window.location.search);
            const foodList = await response.json();
            
            foodList.forEach((food) => {
                const marker = new AdvancedMarkerElement({
                    map: map,
                    position: {
                        lat: food.mitra.latitude,
                        lng: food.mitra.longitude,
                    },
                    title: food.name
                });

                const infoWindow = new InfoWindow({pixelOffset: {height: -2}, ariaLabel: food.name});
                
                const infoWindowContent = `
                <div class="p-2">
                    <h2 class="text-2xl font-bold">${food.name}</h2>
                    <h3>${food.mitra.name}</h3>
                    <p>Pickup time : ${food.start_pickup.substring(0, food.start_pickup.length-3)} - ${food.end_pickup.substring(0, food.end_pickup.length-3)}</p>
                    <a class="mt-2 underline text-primary block" href="/food/${food.id}">View detail food</a>
                </div>
                `;

                infoWindow.setOptions({content: infoWindowContent});

                marker.addListener('gmp-click', () => {
                    infoWindow.open({
                        anchor: marker,
                        map,
                    });
                });
            });
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        init();
    </script>
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
    <script>
        document.querySelector("#distance").addEventListener('change', () => {
            document.querySelector("#form").submit();
        });

        document.querySelector("#category").addEventListener('change', () => {
            document.querySelector("#form").submit();
        });
    </script>
@endsection
