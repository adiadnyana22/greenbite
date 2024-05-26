@extends('adminComponent.default')

@section('title', 'GreenBite Makanan')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Makanan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Makanan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ asset('assets/user/images/food/'.$food->food_category_id.($food->id % 4 + 1)).'.jpeg' }}" alt="Food" class="w-100" style="height: 200px; object-fit: cover">
                </div>
                <div class="col-lg-12">
                    <h1 class="mb-3 mt-2 text-dark">{{ $food->name }}</h1>
                    <div>
                        <b>Stok</b> : {{ $food->stock }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Kategori Makanan</b> : {{ $food->category->name }}
                        </div>
                        <div class="col-lg-6">
                            <b>Jumlah Hari Sebelum Kedaluwarsa</b> : {{ $food->day_to_expiration }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Rating</b> : {{ $food->rating }} / 5 <i class="fas fa-star"></i>
                        </div>
                        <div class="col-lg-6">
                            <b>Jumlah Penilaian</b> : {{ $food->order_count }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Minimum Jumlah Makanan Dalam Satu Paket</b> : {{ $food->min_qty }}
                        </div>
                        <div class="col-lg-6">
                            <b>Makimum Jumlah Makanan Dalam Satu Paket</b> : {{ $food->max_qty }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Jam Awal Pengambilan Makanan</b> : {{ $food->start_pickup }}
                        </div>
                        <div class="col-lg-6">
                            <b>Jam Akhir Pengambilan Makanan</b> : {{ $food->end_pickup }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Harga Normal</b> : {{ number_format($food->normal_price) }}
                        </div>
                        <div class="col-lg-6">
                            <b>Harga Sekarang</b> : {{ number_format($food->current_price) }}
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('adminFood') }}" class="btn btn-info float-right mr-3 mt-2">Kembali</a>
        </div>
    </div>
@endsection

@section('page-script')
@endsection
