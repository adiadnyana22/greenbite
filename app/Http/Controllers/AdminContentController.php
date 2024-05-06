<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminContentController extends Controller
{
    public function voucherListPage() {
        $vouchers = Voucher::all();

        return view('adminPage.voucher')->with('voucherList', $vouchers);
    }

    public function voucherEditPage(Voucher $voucher) {
        return view('adminPage.voucher-edit')->with('voucher', $voucher);
    }

    public function voucherEditMethod(Voucher $voucher, Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'required|numeric|min:1|max:100',
            'max_nominal' => 'required|numeric',
            'min_order_nominal' => 'required|numeric',
        ]);

        $voucher->name = $request->name;
        $voucher->description = $request->description;
        $voucher->percentage = $request->percentage;
        $voucher->max_nominal = $request->max_nominal;
        $voucher->min_order_nominal = $request->min_order_nominal;
        $voucher->save();

        return redirect()->route('adminVoucher');
    }

    public function voucherDeleteMethod(Voucher $voucher) {
        $voucher->delete();

        return redirect()->route('adminVoucher');
    }

    public function voucherAddPage() {
        return view('adminPage.voucher-add');
    }

    public function voucherAddMethod(Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'required|numeric|min:1|max:100',
            'max_nominal' => 'required|numeric',
            'min_order_nominal' => 'required|numeric',
        ]);

        $voucher = new Voucher();
        $voucher->name = $request->name;
        $voucher->description = $request->description;
        $voucher->percentage = $request->percentage;
        $voucher->max_nominal = $request->max_nominal;
        $voucher->min_order_nominal = $request->min_order_nominal;
        $voucher->save();

        return redirect()->route('adminVoucher');
    }

    public function newsListPage() {
        $newsList = News::all();

        return view('adminPage.news')->with('newsList', $newsList);
    }

    public function newsDetailPage(News $news) {
        return view('adminPage.news-detail')->with('news', $news);
    }

    public function newsEditPage(News $news) {
        return view('adminPage.news-edit')->with('news', $news);
    }

    public function newsEditMethod(News $news, Request $request) {
        $validateReq = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'picture' => 'image|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $news->title = $request->title;
        $news->content = $request->content;
        if($request->file('picture')){
            File::delete('assets/user/images/news/'.$news->image);
            $file = $request->file('picture');
            $filename = Str::upper(Str::random(16)).'.'.$file->getClientOriginalExtension();
            $file->move('assets/user/images/news', $filename);
            $news->image = $filename;
        };
        $news->save();

        return redirect()->route('adminNews');
    }

    public function newsAddPage() {
        return view('adminPage.news-add');
    }

    public function newsAddMethod(Request $request) {
        $validateReq = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'picture' => 'required|image|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        $news->date = Carbon::now();

        $file = $request->file('picture');
        $filename = Str::upper(Str::random(16)).'.'.$file->getClientOriginalExtension();
        $file->move('assets/user/images/news', $filename);
        $news->image = $filename;

        $news->save();

        return redirect()->route('adminNews');
    }

    public function newsDeleteMethod(News $news) {
        File::delete('assets/user/images/news/'.$news->image);
        $news->delete();

        return redirect()->route('adminNews');
    }
}
