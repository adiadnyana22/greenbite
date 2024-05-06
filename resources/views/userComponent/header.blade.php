<header class="fixed w-full top-4 z-20">
    <nav class="container mx-auto py-4 px-8 bg-white flex justify-between rounded-[25px] shadow-lg">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/user/images/logoLandscape.png') }}" alt="Logo" class="h-12"></a>
        <ul class="flex justify-end items-center gap-7 text-lg">
            <li><span class="text-coin flex items-center gap-1"><i class='bx bx-coin' ></i> {{ \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->coin : 0 }}</span></li>
            <li><a href="{{ route('wishlist') }}" class="text-gray-500 flex items-center gap-1 transition hover:text-black"><i class='bx bxs-heart' ></i> Wishlist</a></li>
            <li><a href="{{ route('history') }}" class="text-gray-500 flex items-center gap-1 transition hover:text-black"><i class='bx bxs-food-menu' ></i> Order</a></li>
            @if (\Illuminate\Support\Facades\Auth::user())
            <li>
                <div x-data="{dropdownMenu: false}" class="relative">
                    <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center bg-white rounded-md">
                        <span class="text-gray-500 flex items-center gap-1 transition hover:text-black"><i class='bx bxs-user-circle' ></i> Profile <i class='bx bx-chevron-down'></i></span>
                    </button>
                    <div x-show="dropdownMenu" x-on:click.away="dropdownMenu = false" style="z-index: 999; display: none;" class="absolute right-0 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl w-44">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-500 hover:text-black flex gap-2 items-center">
                            <i class="bx bxs-user-detail"></i> Personal Info
                        </a>
                        <a href="{{ route('voucher') }}" class="block px-4 py-2 text-gray-500 hover:text-black flex gap-2 items-center">
                            <i class="bx bxs-purchase-tag"></i> Voucher
                        </a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-500 hover:text-black flex gap-2 items-center">
                            <i class="bx bx-log-out"></i> Logout
                        </a>
                    </div>
                </div>
            </li>
            @endif
            @if (!\Illuminate\Support\Facades\Auth::user())
            <li><a href="{{ route('login') }}" class="text-gray-500 flex items-center gap-1 transition hover:text-black"><i class='bx bx-log-in' ></i> Login</a></li>
            @endif
            <li><a href="{{ route('foodList') }}" class="bg-primary text-white px-4 py-2 rounded-lg transition hover:bg-secondary">Find Food</a></li>
        </ul>
    </nav>
</header>