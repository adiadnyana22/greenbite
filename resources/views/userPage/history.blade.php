@extends('userComponent.default')

@section('title', 'GreenBite')

@section('headExtention')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
    <!-- News -->
    <section class="pt-[150px] lg:pt-[200px] pb-16">
        <div class="container mx-auto">
            <div>
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-5xl font-bold">Order</h1>
                </div>
                @foreach ($orderList as $order)
                <div class="my-3 bg-secondary rounded-lg" x-data="{ modelOpen: false }">
                    <div class="bg-white rounded-lg border border-gray-400/20 transition hover:border-black px-8 py-6 block sm:flex gap-3 justify-between w-full cursor-pointer" @click="modelOpen = true;">
                        <div>
                            <p class="text-sm mb-5">{{ \Carbon\Carbon::parse($order->date)->format('l, d F Y') }}</p>
                            <h2 class="text-2xl font-bold">{{ $order->food->name }}</h2>
                            <h3 class="mb-3">{{ $order->food->mitra->name }}</h3>
                            <span class="text-gray-400">Pickup Time : {{ \Carbon\Carbon::createFromFormat('H:i:s', $order->food->start_pickup)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $order->food->end_pickup)->format('H:i') }}</span>
                        </div>
                        <div class="flex flex-col-reverse sm:flex-col justify-between items-stretch sm:items-end gap-2 mt-4 sm:mt-0">
                            <div class="flex gap-2 w-full sm:w-auto">
                                @if ($order->status == 0)
                                <div class="rounded-full bg-yellow-500 px-4 py-2 text-white border border-yellow-500 text-center w-full sm:w-auto">Wating for payment</div>
                                @endif
                                @if ($order->status == 1)
                                    @if (\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->lt(\Carbon\Carbon::now()))
                                    <div class="rounded-full bg-red-500 px-4 py-2 text-white border border-red-500 text-center w-full sm:w-auto">Order Expired</div>
                                    @else
                                    <div class="rounded-full bg-primary px-4 py-2 text-white border border-primary text-center w-full sm:w-auto">Wating for pickup</div>
                                    @endif
                                @endif
                                @if ($order->status == 2)
                                <div class="rounded-full bg-primary px-4 py-2 text-white border border-primary text-center w-full sm:w-auto">Wating for review</div>
                                @endif
                                @if ($order->status == 3)
                                <div class="rounded-full bg-secondary px-4 py-2 text-white border border-secondary text-center w-full sm:w-auto">Order Complete</div>
                                @endif
                                @if ($order->status == 9)
                                <div class="rounded-full bg-red-500 px-4 py-2 text-white border border-red-500 text-center w-full sm:w-auto">Order Fail</div>
                                @endif
                            </div>
                            <div class="flex gap-3 items-end">
                                <span class="text-gray-400 text-sm">TOTAL BIAYA</span>
                                <p class="text-2xl font-medium">Rp. {{ number_format($order->grand_nominal) }}</p>
                            </div>
                        </div>
                    </div>
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
                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                            >
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 ">My Order</h1>

                                    <button type="button" @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mt-8"> 
                                    <span class="text-gray-400">{{ $order->order_code }}</span>
                                    <h2 class="text-2xl font-medium pt-4">{{ $order->food->name }}</h2>
                                    <h3 class="pb-4">{{ $order->food->mitra->name }}</h3>
                                    <div class="flex justify-between">
                                        <p>{{ \Carbon\Carbon::parse($order->date)->format('l, d F Y') }}</p>
                                        <p>Pickup Time : {{ \Carbon\Carbon::createFromFormat('H:i:s', $order->food->start_pickup)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $order->food->end_pickup)->format('H:i') }}</p>
                                    </div>
                                    <ul class="pt-6 text-gray-400 flex flex-col gap-2">
                                        <li class="flex justify-between">
                                            <div>Makanan x {{ $order->qty }}</div>
                                            <div>Rp {{ number_format($order->total_food_price) }}</div>
                                        </li>
                                        @if ($order->coin_nominal)
                                        <li class="flex justify-between">
                                            <div>Coin</div>
                                            <div>-Rp {{ number_format($order->coin_nominal) }}</div>
                                        </li>
                                        @endif
                                        @if ($order->voucher_nominal)
                                        <li class="flex justify-between">
                                            <div>Voucher Discount</div>
                                            <div>-Rp {{ number_format($order->voucher_nominal) }}</div>
                                        </li>
                                        @endif
                                        <li class="flex justify-between">
                                            <div class="text-lg font-bold text-black">Total Pembayaran</div>
                                            <div class="text-lg font-bold text-black">Rp {{ number_format($order->grand_nominal) }}</div>
                                        </li>
                                    </ul>
                                    @if ($order->status == 1 && \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->gt(\Carbon\Carbon::now()))
                                    <div class="pt-8 pb-4 flex flex-col justify-center items-center">
                                        <p class="text-center mb-4">Datang ke merchant dan tunjukkan qr code ini</p>
                                        <div id="qrcode{{ $order->id }}"></div>
                                        <script type="text/javascript">
                                            new QRCode(document.getElementById("qrcode{{ $order->id }}"), "{{ $order->order_code }}");
                                        </script>
                                    </div>
                                    @endif
                                    @if($order->status == 2)
                                    <a href="{{ route('review', $order->id) }}" class="block text-center py-3 px-4 rounded-lg bg-secondary text-white mt-8 border border-secondary transition hover:text-black hover:bg-transparent">Tulis ulasan</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($order->status == 1 && \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->gt(\Carbon\Carbon::now()))
                    <div class="px-4 py-3 text-white flex justify-between items-center">
                        <div>Notifikasi Order</div>
                        <div class="flex items-center gap-3">
                            <div>Off</div>
                            <label for="toggle{{ $order->id }}" class="flex items-center cursor-pointer select-none text-dark dark:text-white">
                                <div class="relative">
                                    <input type="checkbox" id="toggle{{ $order->id }}" class="peer sr-only" {{ $order->notification ? 'checked' : '' }} x-on:change='updateNotification({{ $order->id }})' />
                                    <div class="block h-8 rounded-full dark:bg-dark-2 bg-gray-200 w-14"></div>
                                    <div class="absolute w-6 h-6 transition bg-secondary rounded-full dot dark:bg-dark-4 left-1 top-1 peer-checked:translate-x-full peer-checked:bg-primary"></div>
                                </div>
                            </label>
                            <div>On</div>
                        </div>
                    </div>
                    @endif
                </div>                    
                @endforeach
            </div>
        </div>
    </section>

    
@endsection

@section('footExtention')
    <script>
        async function updateNotification(orderId) {
            const response = await fetch('{{ route('notificationToggleAPI') }}', { method: "POST", body: JSON.stringify({ "order_id": orderId, "_token": "{{ csrf_token() }}" }), headers: { "Content-Type": "application/json" } });
        }
    </script>
@endsection