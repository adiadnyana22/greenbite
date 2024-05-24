@extends('adminComponent.default')

@section('title', 'GreenBite Daftar Pesanan')

@section('page-style')
    <link href="{{ asset(asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css')) }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pesanan</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Pemesanan</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Makanan</th>
                            <th>Jumlah Makanan</th>
                            <th>Nama Pemesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Waktu Pemesanan</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Makanan</th>
                            <th>Jumlah Makanan</th>
                            <th>Nama Pemesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($orderList as $order)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ date("d/m/Y H:i:s", strtotime($order->created_at)) }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->food->name }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>{{ $order->user->name }}</td>
                                @if ($order->status == 0)
                                <td class="text-danger">Fail</td>
                                @endif
                                @if ($order->status == 1 && \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->lt(\Carbon\Carbon::now()))
                                <td class="text-danger">Expired</td>
                                @elseif ($order->status == 1)
                                <td class="text-warning">Waiting Pickup</td>
                                @endif
                                @if ($order->status == 2)
                                <td class="text-success">Waiting Review</td>
                                @endif
                                @if ($order->status == 3)
                                <td class="text-success">Complete</td>
                                @endif
                                @if ($order->status == 9)
                                <td class="text-danger">Fail</td>
                                @endif
                                <td class="d-flex flex-wrap" style="gap: .5rem">
                                    <a href="{{ route('adminOrderDetail', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
