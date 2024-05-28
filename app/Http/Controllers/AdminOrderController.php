<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function orderListPage() {
        $orderList = Mitra::where('id', '=', Auth::user()->mitra->mitra_id)->first()->mitraOrder();

        return view('adminPage.order')->with('orderList', $orderList);
    }

    public function orderDetailPage(Order $order) {
        return view('adminPage.order-detail')->with('order', $order);
    }

    public function orderConfirm(Request $request, Order $order) {
        $order->status = 2;
        $order->save();

        return redirect()->route('adminOrder');
    }

    public function qrPage() {
        return view('adminPage.qr');
    }

    public function qrScanAPI(Request $request) {
        $validateReq = $request->validate([
            'transaction_code' => 'required',
        ]);

        $transaction = Order::where('order_code', '=', $request->transaction_code)->with('food')->with('user')->first();

        if(!$transaction || $transaction->status != 1 || $transaction->food->mitra_id != Auth::user()->mitra->mitra_id || Carbon::createFromFormat('Y-m-d H:i:s', substr($transaction->date, 0, 10).' '.$transaction->food->end_pickup)->lt(Carbon::now())) return [ 'status' => 0 ];

        return [ 'status' => 1, 'transaction' =>  $transaction];
    }
}
