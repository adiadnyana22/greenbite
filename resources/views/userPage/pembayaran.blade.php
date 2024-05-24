@extends('userComponent.clean')

@section('title', 'GreenBite')

@section('content')
    <section class="h-screen w-screen bg-[#F4F4F4]" x-data="{ coin: {{ $coinNominal }}, voucher: {{ $voucherNominal }} }">
        <div class="h-screen max-w-full w-[700px] mx-auto px-4 sm:px-16 pt-12 pb-16 overflow-auto">
            <div>
                <div class="mt-6 mb-4">
                    <h1 class="text-3xl font-bold">Pembayaran</h1>
                </div>
                <div class="bg-white rounded-lg shadow mb-5 px-6 py-4">
                    <p class="text-sm text-gray-500 pb-6">{{ $kodeTransaksi }}</p>
                    <h2 class="font-medium text-xl mb-6">{{ $food->name }}</h2>
                    <div class="flex justify-between items-center my-2">
                        <span class="text-gray-500">Makanan</span>
                        <span class="text-gray-500">Rp{{ number_format($grandTotal - $coinNominal - $voucherNominal) }}</span>
                    </div>
                    <div class="flex justify-between items-center my-2" x-show="coin != 0">
                        <span class="text-gray-500">Coin</span>
                        <span class="text-gray-500">-Rp{{ number_format($coinNominal) }}</span>
                    </div>
                    <div class="flex justify-between items-center my-2" x-show="voucher != 0">
                        <span class="text-gray-500">Voucher Discount</span>
                        <span class="text-gray-500">-Rp{{ number_format($voucherNominal) }}</span>
                    </div>
                    <div class="flex justify-between items-center my-2">
                        <span class="font-bold text-lg">Total Pembayaran</span>
                        <span class="font-bold text-lg">Rp{{ number_format($grandTotal) }}</span>
                    </div>
                    <button type="button" id="pay" class="rounded bg-primary px-4 py-3 text-center text-white block w-full mb-2 mt-8 border border-primary transition hover:text-primary hover:bg-transparent">Bayar</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footExtention')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
          // Optional
          onSuccess: async function(result){
            // Hit API untuk ubah status transaksi menjadi berhasil
            const response = await fetch('{{ route('transactionStatusAPI') }}', { method: "POST", body: JSON.stringify({ "transaction_id": '{{ $kodeTransaksi }}', "transaction_status": 1, "_token": "{{ csrf_token() }}"  }), headers: { "Content-Type": "application/json" } });
            // Pindah ke halaman sukses
            window.location.href = '{{ route('success') }}';
          },
          // Optional
          onPending: async function(result){
            // Hit API untuk ubah status transaksi menjadi gagal
            const response = await fetch('{{ route('transactionStatusAPI') }}', { method: "POST", body: JSON.stringify({ "transaction_id": '{{ $kodeTransaksi }}', "transaction_status": 9, "_token": "{{ csrf_token() }}" }), headers: { "Content-Type": "application/json" } });
            // Pindah ke halaman gagal
            window.location.href = '{{ route('fail') }}';
          },
          // Optional
          onError: async function(result){
            // Hit API untuk ubah status transaksi menjadi gagal
            const response = await fetch('{{ route('transactionStatusAPI') }}', { method: "POST", body: JSON.stringify({ "transaction_id": '{{ $kodeTransaksi }}', "transaction_status": 9, "_token": "{{ csrf_token() }}" }), headers: { "Content-Type": "application/json" } });
            // Pindah ke halaman gagal
            window.location.href = '{{ route('fail') }}';
          }
        });
      };
    </script>
@endsection