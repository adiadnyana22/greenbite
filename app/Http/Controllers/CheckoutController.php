<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public function checkoutPage(Request $request) {
        $food = Food::where('id', '=', Session::get('food_id'))->first();
        $voucher = User::where('id', '=', Auth::user()->id)->first()->unusedVouchers();
        $qty = Session::get('qty');
        $total_price = $food->current_price * $qty;

        Session::put('total_price', $total_price);

        $voucherList = array();
        foreach ($voucher as $vc){
            array_push($voucherList, array("id" => $vc->id, "name" => $vc->name, "description" => $vc->description, "percentage" => $vc->percentage, "max_nominal" => $vc->max_nominal, "actual_disc" => min($vc->percentage/100 * $total_price, $vc->max_nominal), "min_transaction_nominal" => $vc->min_order_nominal));
        }

        return view('userPage.checkout')
            ->with('food', $food)
            ->with('qty', $qty)
            ->with('totalPrice', $total_price)
            ->with('voucher', $voucherList);
    }

    public function checkoutMtd(Request $request) {
        $validateReq = $request->validate([
            'food_id' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        $validateReq = $request->validate([
            'use_coin' => 'in:Yes',
            'coin' => 'numeric',
            'voucher' => 'numeric',
            'voucher_nominal' => 'numeric',
            'total_pay' => 'required|numeric',
            'sk' => 'required|in:Yes',
        ]);
        
        $kode_transaksi = 'GRBT-'.rand(1000000000, 9999999999).str_pad(Session::get('food_id'), 3, STR_PAD_LEFT);
        $voucher = Voucher::where('id', '=', $request->voucher)->first();
        $voucherDisc = ($voucher) ? min($voucher->percentage/100 * Session::get('total_price'), $voucher->max_nominal) : 0;
        $grand_total = $request->total_pay;

        $food_id = Session::get('food_id');
        $qty = Session::get('qty');
        $total_price = Session::get('total_price');
        $voucher_id = ($request->voucher) ? $request->voucher : 0;
        $voucher_nominal = ($request->voucher) ? $request->voucher_nominal : 0;
        $coin = ($request->use_coin) ? $request->coin : 0;

        if($coin != 0) {
            $useCoin = new Coin();
            $useCoin->nominal = $coin;
            $useCoin->type = 0;
            $useCoin->user_id = Auth::user()->id;
            $useCoin->save();
        }

        // Add to table Order
        $transaksi = new Order();
        $transaksi->order_code = $kode_transaksi;
        $transaksi->food_id = $food_id;
        $transaksi->user_id = Auth::user()->id;
        $transaksi->qty = $qty;
        $transaksi->date = Carbon::today();
        $transaksi->total_food_price = $total_price;
        $transaksi->voucher_nominal = $voucher_nominal;
        $transaksi->coin_nominal = $coin;
        $transaksi->grand_nominal = $grand_total;
        $transaksi->status = 0;
        $transaksi->notification = 0;
        $transaksi->save();

        // Kurangi koin & voucher
        if($coin != 0) {
            $user = User::where('id', '=', Auth::user()->id)->first();
            $user->coin = 0;
            $user->save();
        }

        if($voucher_id != 0) {
            $voucherUse = new VoucherUse();
            $voucherUse->user_id = Auth::user()->id;
            $voucherUse->voucher_id = $voucher_id;
            $voucherUse->order_id = $transaksi->id;
            $voucherUse->save();
        }

        // Pembuatan persiapan pembayaran Midtrans

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->total_pay,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            )
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snap token di db
        $transaksi->snap_token = $snapToken;
        $transaksi->save();

        Session::put('kode_transaksi', $kode_transaksi);
        Session::put('coin_nominal', ($request->use_coin) ? $request->coin : 0);
        Session::put('voucher_nominal', ($voucher) ? $voucherDisc : 0);
        Session::put('grand_total', $grand_total);

        return redirect()->route('paymentPage');
    }

    public function paymentPage(Request $request) {
        // Get transaction by trx id
        $transaction = Order::where('order_code', '=', Session::get('kode_transaksi'))->first();

        $food = Food::where('id', '=', Session::get('food_id'))->first();

        return view('userPage.pembayaran')
            ->with('food', $food)
            ->with('kodeTransaksi', Session::get('kode_transaksi'))
            ->with('snapToken', $transaction->snap_token)
            ->with('grandTotal', Session::get('grand_total'))
            ->with('voucherNominal', Session::get('voucher_nominal'))
            ->with('coinNominal', Session::get('coin_nominal'));
    }

    public function transactionStatusAPI(Request $request) {
        $validateReq = $request->validate([
            'transaction_id' => 'required',
            'transaction_status' => 'required',
        ]);

        $transaction = Order::where('order_code', '=', $request->transaction_id)->first();
        
        if(!$transaction) return [ 'status' => 0 ];

        $transaction->status = $request->transaction_status;
        $transaction->save();

        if($request->transaction_status == 1) {
            $transaction->food->stock = $transaction->food->stock - $transaction->qty;
            $transaction->food->save();
        }

        return [ 'status' => 1 ];
    }

    public function successPage() {
        return view('userPage.success');
    }

    public function failPage() {
        return view('userPage.fail');
    }
}
