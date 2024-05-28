@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <div class="min-h-screen w-screen" x-data="app">
        <section class="p-12 sm:p-24 pb-8">
            <h1 class="text-4xl font-light">Register Mitra <strong class="font-bold"><span class="text-primary">Green</span>Bite</strong></h1>
            <form action="{{ route('registerMitraMtd') }}" class="mt-12" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
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
                    </div>
                    <div>
                        <label for="name" class="block mb-4">Store Name :
                            <input type="text" id="store_name" name="store_name" placeholder="Enter your store name ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                            @error('store_name')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                        </label>
                        <label for="logo" class="block mb-4">Store Logo :
                            <input type="file" id="store_logo" name="store_logo" class="block w-full bg-gray-100 rounded-lg px-6 py-2 mt-1" accept="image/*">
                            @error('store_logo')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                        </label>
                        <label for="password" class="block mb-4">Store Address :
                            <input type="text" id="store_address" name="store_address" placeholder="Enter your store address ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1">
                            @error('store_address')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                        </label>
                        <label for="confirm_password" class="block mb-4">Store Location :
                            <div class="flex justify-between items-center gap-1">
                                <input type="text" id="store_location" name="store_location" placeholder="Select location on map ..." class="block w-full bg-gray-100 rounded-lg px-6 py-3 mt-1" disabled>
                                <input type="hidden" id="store_location_lat" name="store_location_lat">
                                <input type="hidden" id="store_location_lng" name="store_location_lng">
                                <button type="button" class="bg-gray-600 text-white rounded-lg w-48 px-6 py-3 flex justify-between items-center gap-1" @click="modelOpen = true;"><i class='bx bxs-map' ></i> Open Map</button>
                            </div>
                            @error('store_location_lat')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                            @error('store_location_lng')<p class="py-2 text-red-500 italic">{{ $message }}</p>@enderror
                        </label>
                    </div>
                </div>
                <button class="block w-full bg-primary text-white rounded-lg px-6 py-3 font-bold tracking-wider my-12" @click="count = 1" x-show="count == 0">Register</button>
                <div class="flex justify-center items-center px-6 py-3 my-12 rounded bg-gray-500 text-white" x-show="count == 1">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Tunggu beberapa saat
                </div>
                <hr>
                <div class="text-center py-8"><a href="{{ route('home') }}" class="text-gray-500 flex items-center gap-2 justify-center transition hover:text-black"><i class='bx bx-left-arrow-alt text-lg'></i> Kembali ke beranda</a></div>
            </form>
        </section>

        @if ($msg)
        <button type="button" x-init="$nextTick(() => { openToast() })" @click="closeToast()" x-show="open" x-transition.duration.300ms class="fixed right-4 top-4 z-50 rounded-md bg-green-500 px-6 py-2 text-white transition hover:bg-green-600">
            <div class="flex items-center space-x-4">
                <span class="text-4xl"><i class="bx bx-check"></i></span>
                <div class="text-left">
                    <h2 class="font-bold">Registrasi berhasil</h2>
                    <p class="text-sm">{{ $msg }}</p>
                </div>
            </div>
        </button>
        @endif

        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                ></div>

                <div x-cloak x-show="modelOpen"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="inline-block w-full max-w-4xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-4xl"
                >
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Store Location</h1>

                        <button type="button" @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-8"> 
                        <div id="map" class="w-full h-[400px]"></div>
                        <button type="button" class="mt-2 px-4 py-2 bg-secondary text-white rounded-lg block w-full" @click="modelOpen = false">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footExtention')
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFCavjPZcDlfq93MQMbnzlu_a4Q5pnXi0&callback=initMap&v=weekly&solution_channel=GMP_CCS_geocodingservice_v1"
      defer
    ></script>
    <script>
      /**
       * @license
       * Copyright 2019 Google LLC. All Rights Reserved.
       * SPDX-License-Identifier: Apache-2.0
       */
      let map;
      let marker;
      let geocoder;
      let responseDiv;
      let response;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: { lat: -6.177807389949748, lng: 106.8236927647547 },
          mapTypeControl: false,
        });
        geocoder = new google.maps.Geocoder();

        const inputText = document.createElement("input");

        inputText.type = "text";
        inputText.placeholder = "Enter a location";
        inputText.classList.add("px-4", "py-2", "rounded-lg", "shadow-lg", "mt-2", "ml-2", "text-base");

        const submitButton = document.createElement("input");

        submitButton.type = "button";
        submitButton.value = "Search";
        submitButton.classList.add("px-4", "py-2", "rounded-lg", "shadow-lg", "mt-2", "ml-2", "text-base", "bg-secondary", "text-white");

        const clearButton = document.createElement("input");

        clearButton.type = "button";
        clearButton.value = "Clear";
        clearButton.classList.add("button", "button-secondary");
        clearButton.classList.add("px-4", "py-2", "rounded-lg", "shadow-lg", "mt-2", "ml-2", "text-base", "bg-white");

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(clearButton);
        marker = new google.maps.Marker({
          map,
        });
        map.addListener("click", (e) => {
          geocode({ location: e.latLng });
        });
        submitButton.addEventListener("click", () =>
          geocode({ address: inputText.value })
        );
        clearButton.addEventListener("click", () => {
          clear();
        });
        clear();
      }

      function clear() {
        marker.setMap(null);
        document.querySelector("#store_location").value = '';
        document.querySelector("#store_location_lat").value = '';
        document.querySelector("#store_location_lng").value = '';
      }

      function geocode(request) {
        clear();
        geocoder
          .geocode(request)
          .then((result) => {
            const { results } = result;

            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            marker.setMap(map);
            document.querySelector("#store_location").value = results[0].formatted_address;
            document.querySelector("#store_location_lat").value = results[0].geometry.location.lat();
            document.querySelector("#store_location_lng").value = results[0].geometry.location.lng();

            return results;
          })
          .catch((e) => {
            alert("Please enter specific name");
          });
      }

      window.initMap = initMap;
    </script>
    <script>
        let timer;

        function app() {
            return {
                open: false,
                
                modelOpen: false,

                count: 0,

                openToast() {
                    if (this.open) return;
                    this.open = true;

                    clearTimeout(timer);

                    timer = setTimeout(() => {
                        this.open = false;
                    }, 8000);
                },

                closeToast() {
                    this.open = false;
                },
            }
        }
    </script>
@endsection