@extends('adminComponent.default')

@section('title', 'GreenBite Pesanan')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesanan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mb-3 mt-2 text-dark">{{ $order->order_code }}</h1>
                    <h3>Waktu Pemesanan : {{ date("d/m/Y H:i:s", strtotime($order->created_at)) }}</h3>
                    <h4>Waktu Pengambilan : {{ date("d/m/Y", strtotime($order->date)).' '.$order->food->start_pickup.' - '.$order->food->end_pickup }}</h3>
                    <div class="row py-3">
                        <div class="col-12">
                            <b>Nama Makanan</b> : {{ $order->food->name }}
                        </div>
                        <div class="col-6">
                            <b>Nama Pemesan</b> : {{ $order->user->name }}
                        </div>
                        <div class="col-6">
                            <b>Email Pemesan</b> : {{ $order->user->email }}
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12">
                            <div class="mb-2">
                                <b>Jumlah Makanan</b> : {{ $order->qty }}
                            </div>
                            <div class="mb-2">
                                <b>Total Harga Makanan</b> : {{ number_format($order->total_food_price) }} ({{ $order->qty }} x {{ number_format($order->food->current_price) }})
                            </div>
                            <div class="mb-2">
                                <b>Coin Use</b> : - {{ number_format($order->coin_nominal) }}
                            </div>
                            <div class="mb-2">
                                <b>Voucher Use</b> : - {{ number_format($order->voucher_nominal) }}
                            </div>
                            <div class="mb-2 h2 text-dark">
                                <b>Total Keseluruhan</b> : {{ number_format($order->grand_nominal) }}
                            </div>
                        </div>
                    </div>
                </div>
                @if ($order->status == 1 && \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->gte(\Carbon\Carbon::now()))
                <div class="col-12 d-flex">
                    <form action="{{ route('adminOrderConfirm', $order->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button class="btn btn-success mr-3 mt-2">Confirm</button>
                    </form>
                </div>
                @endif
                @if ($order->status == 1 && \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->lt(\Carbon\Carbon::now()))
                <div class="bg-danger py-2 w-100 h2 text-center text-white mb-2">
                    ORDER EXPIRED
                </div>    
                @endif
                @if ($order->status == 2)
                <div class="bg-success py-2 w-100 h2 text-center text-white mb-2">
                    ORDER WATING FOR REVIEW FROM CUSTOMER
                </div>    
                @endif
                @if ($order->status == 3)
                <div class="bg-success py-2 w-100 h2 text-center text-white mb-2">
                    ORDER COMPLETE
                </div>    
                @endif
                @if ($order->status == 9)
                <div class="bg-danger py-2 w-100 h2 text-center text-white mb-2">
                    ORDER FAIL
                </div>    
                @endif
            </div>
            <a href="{{ route('adminOrder') }}" class="btn btn-info float-right mr-3 mt-2">Kembali</a>
        </div>
    </div>
@endsection

@section('page-script')
@endsection
