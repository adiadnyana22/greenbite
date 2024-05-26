@extends('adminComponent.default')

@section('title', 'GreenBite Makanan')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Makanan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Makanan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('adminFoodAddMethod') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama ..." required>
                    @error('name')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" class="form-control" name="stock" value="{{ old('stock') }}" placeholder="Stok ..." required>
                    @error('stock')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <label class="form-label">Minimum Jumlah Makanan Dalam Satu Paket</label>
                        <input type="number" class="form-control" name="min_qty" value="{{ old('min_qty') }}" placeholder="Minimum Jumlah Makanan Dalam Satu Paket ..." required>
                        @error('min_qty')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Maksimum Jumlah Makanan Dalam Satu Paket</label>
                        <input type="number" class="form-control" name="max_qty" value="{{ old('max_qty') }}" placeholder="Maksimum Jumlah Makanan Dalam Satu Paket ..." required>
                        @error('max_qty')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Hari Sebelum Kedaluwarsa <b>(Nilai 0 berarti besok kedaluwarsa, 1 berarti dua hari lagi kedaluwarsa, dan seterusnya)</b></label>
                    <input type="number" class="form-control" name="day_to_expiration" value="{{ old('day_to_expiration') }}" placeholder="Jumlah Hari Sebelum Kedaluwarsa ..." required>
                    @error('day_to_expiration')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <label class="form-label">Jam Awal Pengambilan Makanan</label>
                        <input type="time" class="form-control" name="start_pickup" value="{{ old('start_pickup') }}" placeholder="Jam Awal Pengambilan Makanan ..." required>
                        @error('start_pickup')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Jam Akhir Pengambilan Makanan</label>
                        <input type="time" class="form-control" name="end_pickup" value="{{ old('end_pickup') }}" placeholder="Jam Akhir Pengambilan Makanan ..." required>
                        @error('end_pickup')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <label class="form-label">Harga Normal</label>
                        <input type="number" class="form-control" name="normal_price" value="{{ old('normal_price') }}" placeholder="Harga Normal ..." required>
                        @error('normal_price')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Harga Sekarang</label>
                        <input type="number" class="form-control" name="current_price" value="{{ old('current_price') }}" placeholder="Harga Sekarang ..." required>
                        @error('current_price')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori Makanan</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categoryList as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')<p class="text-danger mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" id="submit" class="btn btn-primary float-right">Tambah</button>
                <a href="{{ route('adminFood') }}" class="btn btn-info float-right mr-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
@endsection
