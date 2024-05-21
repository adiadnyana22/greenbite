@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <section class="h-screen w-screen bg-[#F4F4F4]">
        <div class="h-screen max-w-full w-[700px] mx-auto px-4 sm:px-16 pt-12 pb-16 overflow-auto" x-data="{ isTaCChecked: false }">
            <form action="{{ route('checkoutMtd') }}" method="POST">
                @csrf
                <div class="mt-6 mb-4">
                    <h1 class="text-3xl font-bold">Konfirmasi Pesanan</h1>
                </div>
                <div class="bg-white rounded-lg shadow mb-5 px-6 py-4 flex flex-col gap-5">
                    <div>
                        <h2 class="font-semibold text-2xl mb-4">{{ $food->name }}</h2>
                        <h4 class="text-lg font-medium mb-1">{{ $food->mitra->name }}</h4>
                        <address class="text-gray-400 leading-tight">{{ $food->mitra->address }}</address>
                        <div class="flex justify-between items-center mt-4">
                            <span>Pickup Time</span>
                            <span>{{ \Carbon\Carbon::createFromFormat('H:i:s', $food->start_pickup)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $food->end_pickup)->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow mb-5 px-6 py-4" x-data="{ count: 0, useCoin: false, coin: {{ \Illuminate\Support\Facades\Auth::user()->coin }}, useVoucher: false, voucher: '', voucherList: {{ str_replace('"', "'", json_encode($voucher)) }}, totalPrice: {{ $totalPrice }}, ticketPrice: {{ $totalPrice }}, zero: 0, get totalPay() { return this.totalPrice - ((this.useCoin) ? this.coin : 0) - ((this.useVoucher) ? this.voucherList.find((vc) => vc.id == this.voucher).actual_disc : 0) }  }">
                    <div class="flex justify-between items-center my-2">
                        <span class="text-gray-500">Makanan x {{ $qty }}</span>
                        <span class="text-gray-500">Rp{{ number_format($totalPrice) }}</span>
                    </div>
                    <div class="flex justify-between items-center my-2" x-show="useCoin">
                        <span class="text-gray-500">Coin</span>
                        <span class="text-gray-500">-Rp<span x-text="new Intl.NumberFormat('en-ID').format(coin)"></span></span>
                    </div>
                    <div class="flex justify-between items-center my-2" x-show="useVoucher">
                        <span class="text-gray-500">Voucher Discount</span>
                        <span class="text-gray-500">-Rp<span x-text="(useVoucher) ? new Intl.NumberFormat('en-ID').format(voucherList.find((vc) => vc.id == voucher).actual_disc) : 0"></span></span>
                    </div>
                    <div class="flex justify-between items-center my-2">
                        <span class="font-bold text-lg">Total Pembayaran</span>
                        <span class="font-bold text-lg">Rp<span x-text="new Intl.NumberFormat('en-ID').format(totalPay)"></span></span>
                    </div>
                    <hr class="border-dotted border-gray-500 mb-2">
                    <div class="flex gap-3 my-4 items-center" x-show="coin > 0">
                        <input type="checkbox" name="use_coin" class="w-5 h-5" value="Yes" x-model="useCoin">
                        <input type="hidden" name="coin" x-model="coin">
                        <label for="">Tukarkan {{ number_format(\Illuminate\Support\Facades\Auth::user()->coin) }} Coin GreenBite</label>
                    </div>
                    <div x-data="{ modelOpen: false }">
                        <div x-bind:class="(useVoucher) ? 'rounded border border-secondary px-6 py-3 text-center text-secondary cursor-pointer' : 'rounded border border-gray-500/25 px-6 py-3 text-center text-gray-500 cursor-pointer' " @click="modelOpen =!modelOpen" x-text="(useVoucher) ? 'Voucher potongan Rp' + new Intl.NumberFormat('en-ID').format(voucherList.find((vc) => vc.id == voucher).actual_disc) + ' terpakai' : 'Voucher'">Voucher</div>
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
                                        <h1 class="text-xl font-medium text-gray-800 ">Voucher yang kamu miliki</h1>

                                        <button type="button" @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="mt-8 flex flex-col gap-4" x-show="voucherList.length > 0">
                                        <template x-for="vc in voucherList" :key="vc.id">
                                            <label>
                                                <input class="sr-only peer" name="voucher" type="radio" :value="vc.id" x-model="voucher" x-bind:disabled="ticketPrice < vc.min_transaction_nominal" />
                                                <div class="px-4 py-2 rounded-lg text-seconcary peer-checked:font-semibold peer-checked:bg-secondary peer-checked:text-white border border-secondary" x-bind:class="ticketPrice < vc.min_transaction_nominal ? 'bg-gray-500' : ''">
                                                    <div class="text-xl font-bold" x-text="vc.name" x-bind:class="ticketPrice < vc.min_transaction_nominal ? 'text-black' : ''"></div>
                                                    <div class="flex justify-between">
                                                        <p class="text-sm text-gray-500" x-text="vc.description" x-bind:class="ticketPrice < vc.min_transaction_nominal ? 'text-black' : ''"></p>
                                                        <p class="text-sm text-gray-500" x-text="'min Rp ' + new Intl.NumberFormat('en-ID').format(vc.min_transaction_nominal)" x-bind:class="ticketPrice < vc.min_transaction_nominal ? 'text-black' : ''"></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </template>
                                        <div class="flex justify-center gap-6 mt-4">
                                            <button type="button" class="px-4 py-2 text-gray-500" @click="voucher = 0; useVoucher = false">Hapus Voucher</button>
                                            <button type="button" class="px-4 py-2 bg-secondary text-white rounded-lg" @click="modelOpen = false; useVoucher = ((voucher == 0) ? false : true)">Pakai</button>
                                        </div>
                                    </div>
                                    <div class="mt-8 flex flex-col gap-4" x-show="voucherList.length == 0">
                                        <p>Tidak ada voucher yang bisa dipakai</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_pay" x-model="totalPay">
                    <input type="hidden" name="voucher_nominal" x-model="(useVoucher) ? voucherList.find((vc) => vc.id == voucher).actual_disc : zero">
                    <input type="hidden" name="food_id" value="{{ $food->id }}">
                    <input type="hidden" name="qty" value="{{ $qty }}">
                    <button x-bind:class="'rounded px-4 py-2 text-center text-white block w-full mt-4 mb-2 ' + ((isTaCChecked) ? 'bg-primary transition border border-primary hover:bg-transparent hover:text-primary' : 'bg-gray-400')" x-bind:disabled="!isTaCChecked" @click="count = 1" x-show="count == 0">Konfirmasi</button>
                    <div class="flex justify-center items-center px-4 py-2 mt-4 mb-2 rounded bg-gray-500 text-white" x-show="count == 1">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Tunggu beberapa saat
                    </div>
                </div>
                <div class="flex items-center gap-3 ml-1">
                    <div x-data="{ modelOpen: false }">
                        <div class="flex items-center gap-3 ml-1">
                            <input type="checkbox" id="sk" name="sk" class="w-5 h-5" value="Yes" x-model="isTaCChecked" @click="$event.preventDefault(); modelOpen = true">
                            <label for="sk">Saya menyetujui syarat dan ketentuan</label>
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
                                        <h1 class="text-xl font-medium text-gray-800 ">Syarat dan ketentuan</h1>

                                        <button type="button" @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="mt-8 flex flex-col gap-4">
                                        <ul class="list-disc ml-5 flex flex-col gap-3 text-justify">
                                            <li>
                                                Makanan yang ada disini adalah makanan yang tidak habis terjual oleh merchant, jadi anda tidak bisa memilih makanan apa yang akan anda terima. Walaupun begitu, tetap dipastikan makanan tersebut masih dalam kategori yang sesuai
                                            </li>
                                            <li>
                                                GreenBite tidak bertanggung jawab atas makanan yang anda terima
                                            </li>
                                        </ul>
                                        <div class="flex justify-center gap-6 mt-4">
                                            <button type="button" class="px-4 py-3 bg-secondary text-white rounded-lg w-full" @click="modelOpen = false; isTaCChecked = true">Saya mengerti dan setuju</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('footExtention')
    
@endsection