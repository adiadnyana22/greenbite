<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dashboardPage() {
        $mitraPending = Mitra::where('status', '=', 0)->count();
        $mitraCount = Mitra::where('status', '=', 1)->count();
        
        $count = 0;
        if(Auth::user()->role_id == 2) {
            $orderList = Mitra::where('id', '=', Auth::user()->mitra->mitra_id)->first()->mitraOrderOngoing();
            foreach($orderList as $order) {
                if(Carbon::createFromFormat('Y-m-d H:i:s', substr($order->date, 0, 10).' '.$order->food->end_pickup)->gt(Carbon::now())) $count = $count + 1;
            }
        }

        return view('adminPage.dashboard')->with('mitraPending', $mitraPending)->with('mitraCount', $mitraCount)->with('ongoingOrder', $count);
    }
}
