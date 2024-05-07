<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use App\Mail\NotificationEmail;
use App\Models\Food;
use App\Models\News;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdditionController extends Controller
{
    public function home() {
        $newsList = News::limit(3)->get();

        return view('userPage.index')
            ->with('newsList', $newsList);
    }

    public function foodHomeAPI() {
        $distance = 5;
        $latitude = Cookie::get('latitude');
        $longitude = Cookie::get('longitude');

        $foodList = Food::with('mitra')->whereHas('mitra', function($query) use ($distance, $latitude, $longitude) {
            $query->selectRaw("
                (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude)))) AS jarak")
                ->having('jarak', '<=', $distance);
        })->limit(4)->get();

        return $foodList;
    }

    public function profile() {
        return view('userPage.personal');
    }

    public function profileMtd(Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'password' => 'same:confirm_password',
        ]);

        $user = User::where('id', '=', Auth::user()->id)->first();
        $user->name = $request->name;
        if($request->password) $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('profile');
    }

    public function voucher() {
        $voucherList = User::where('id', '=', Auth::user()->id)->first()->unusedVouchers();

        return view('userPage.voucher')
            ->with('voucherList', $voucherList);
    }

    public function wishlist() {
        $wishlistList = Wishlist::where('user_id', '=', Auth::user()->id)->get();

        return view('userPage.wishlist')
            ->with('wishlistList', $wishlistList);
    }

    public function history() {
        $orderList = Order::where('user_id', '=', Auth::user()->id)->get();

        return view('userPage.history')
            ->with('orderList', $orderList);
    }

    public function notificationToggleAPI(Request $request) {
        $validateReq = $request->validate([
            'order_id' => 'required',
        ]);

        $order = Order::where('id', '=', $request->order_id)->first();

        if(!$order || $order->user_id != Auth::user()->id) return [ 'status' => 0 ];

        $order->notification = !$order->notification;
        $order->save();

        return [ 'status' => 1 ];
    }

    public function sendNotificationJob() {
        $orderList = Order::where('notification', '=', 1)
            ->whereIn('food_id', function($query) {
                $query->select('id')
                ->from('food')
                ->whereTime('start_pickup', '<=', Carbon::now())
                ->whereTime('end_pickup', '>=', Carbon::now());
            })->whereDate('date', '=', Carbon::today())->get();

        foreach($orderList as $order) {
            Mail::to($order->user->email)->send(new NotificationEmail($order->order_code, $order->food->name, $order->food->start_pickup, $order->food->end_pickup, $order->food->mitra->latitude, $order->food->mitra->longitude));

            $order->notification = 2;
            $order->save();
        }

        return [ 'status' => 1 ];
    }
}
