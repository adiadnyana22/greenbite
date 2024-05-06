<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\User;
use App\Models\UserMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginPage() {
        return view('userPage.login');
    }

    public function loginMtd(Request $request) {
        $validateReq = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validateReq)) {
            if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2)) return redirect()->route('adminDashboard');

            return redirect()->route('home');
        }

        return back()->withErrors([
            'login' => "Email atau password tidak cocok",
        ]);
    }

    public function registerUserPage() {
        return view('userPage.register');
    }

    public function registerUserMtd(Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->coin = 0;
        $user->role_id = 3;
        $user->save();
        
        return redirect()->route('login');
    }

    public function logoutMtd() {
        Auth::logout();

        return redirect()->route('login');
    }

    public function registerMitraPage() {
        return view('userPage.mitra')
            ->with('msg', Session::get('msg'));
    }

    public function registerMitraMtd(Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required',
            'store_name' => 'required',
            'store_logo' => 'required|image|file|mimes:jpeg,jpg,png|max:2048',
            'store_address' => 'required',
            'store_location_lat' => 'required|numeric',
            'store_location_lng' => 'required|numeric'
        ]);

        $mitra = new Mitra();
        $mitra->name = $request->store_name;
        $mitra->address = $request->store_address;
        $mitra->latitude = $request->store_location_lat;
        $mitra->longitude = $request->store_location_lng;
        $mitra->status = 0;

        $file = $request->file('store_logo');
        $filename = Str::upper(Str::random(16)).'.'.$file->getClientOriginalExtension();
        $file->move('assets/user/images/merchant', $filename);
        $mitra->logo = $filename;
        $mitra->save();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->coin = 0;
        $user->role_id = 2;
        $user->save();

        $userMitra = new UserMitra();
        $userMitra->user_id = $user->id;
        $userMitra->mitra_id = $mitra->id;
        $userMitra->save();
        
        return redirect()->route('registerMitra')
            ->with('msg', 'Saat akun telah diverifikasi, anda akan mendapatkan email');
    }
}
