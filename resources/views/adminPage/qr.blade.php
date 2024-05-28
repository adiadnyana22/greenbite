@extends('adminComponent.default')

@section('title', 'GreenBite QR Scan Pesanan')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QR Scan Pesanan</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">QR Scan Pesanan</h6>
        </div>
        <div class="card-body">
            <div id="reader" class="w-100"></div>
        </div>
    </div>

    <!-- QR Modal-->
    <div id="qrModalContainer">
        
    </div>
@endsection

@section('page-script')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        async function onScanSuccess(decodedText, decodedResult) {
            const responseJSON = await fetch('{{ route('qrScanAPI') }}', { method: "POST", body: JSON.stringify({ "transaction_code": decodedText, "_token": "{{ csrf_token() }}"  }), headers: { "Content-Type": "application/json" } });
            const response = await responseJSON.json();

            if(response.status == 1) {
                const transaction = response.transaction;

                if($('#qrModal').length > 0 && $('#qrModal').hasClass('show')) return;

                $('#qrModalContainer').html(`
                <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Apakah benar ini pesanan anda?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h2>${transaction.order_code}</h2>
                                <ul class="my-2">
                                    <li><b>Makanan</b> : ${transaction.food.name}</li>
                                    <li><b>Jumlah</b> : ${transaction.qty}</li>
                                    <li><b>Nama Pemesan</b> : ${transaction.user.name}</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                                <form action="/admin/order/verif/${transaction.id}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" href="">Konfirmasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                `);

                $('#qrModal').modal('show');
            }
        }

        function onScanFailure(error) {}

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 1, qrbox: {width: 500, height: 500} },
            /* verbose= */ false);

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
