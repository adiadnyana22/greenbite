<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function newsList(Request $request) {
        $query = $request->input('search');

        $newsList = !$query ? News::all() : News::where('title', 'like', '%'.$query.'%')->get();

        return view('userPage.newsList')
            ->with('newsList', $newsList);
    }

    public function newsDetail(News $news) {
        return view('userPage.newsDetail')
            ->with('news', $news);
    }

    public function newsDetailContent(News $news) {
        return view('userPage.newsDetailContent')
            ->with('news', $news);
    }
}
