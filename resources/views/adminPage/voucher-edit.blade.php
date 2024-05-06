@extends('adminComponent.default')

@section('title', 'GreenBite Voucher')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Voucer</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Voucer</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('adminVoucherEditMethod', $voucher->id) }}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ $voucher->name }}" placeholder="Name ..." required>
                    @error('name')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" name="description" value="{{ $voucher->description }}" placeholder="Deskripsi ..." required>
                    @error('description')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Persentase</label>
                    <input type="number" class="form-control" name="percentage" value="{{ $voucher->percentage }}" placeholder="Persentase ..." required min="1" max="100">
                    @error('percentage')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal Potongan Maksimum</label>
                    <input type="number" class="form-control" name="max_nominal" value="{{ $voucher->max_nominal }}" placeholder="Nominal Potongan Maksimum ..." required>
                    @error('max_nominal')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal Minimum Transaksi</label>
                    <input type="number" class="form-control" name="min_order_nominal" value="{{ $voucher->min_order_nominal }}"  placeholder="Nominal Minimum Transaksi ..." required>
                    @error('min_order_nominal')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" id="submit" class="btn btn-primary float-right">Ubah</button>
                <a href="{{ route('adminVoucher') }}" class="btn btn-info float-right mr-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
@endsection
