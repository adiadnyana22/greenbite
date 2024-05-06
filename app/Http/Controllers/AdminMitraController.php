<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class AdminMitraController extends Controller
{
    public function mitraListPage() {
        $mitraList = Mitra::orderBy('created_at', 'desc')->get();

        return view('adminPage.mitra')->with('mitraList', $mitraList);
    }

    public function mitraDetailPage(Mitra $mitra) {
        return view('adminPage.mitra-detail')->with('mitra', $mitra);
    }

    public function mitraVerif(Request $request, Mitra $mitra) {
        $validateReq = $request->validate([
            'status' => 'required|numeric',
        ]);

        if($request->status != 1 && $request->status != 9) return redirect()->route('adminMitra');

        $mitra->status = $request->status;
        $mitra->save();

        return redirect()->route('adminMitra');
    }
}
