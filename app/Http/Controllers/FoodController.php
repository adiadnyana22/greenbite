<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    public function foodList(Request $request) {
        $search = $request->input('search');
        $distance = $request->input('distance');
        $category = $request->input('category');

        $latitude = Cookie::get('latitude');
        $longitude = Cookie::get('longitude');

        $categoryList = FoodCategory::all();

        $distance = $distance ?? 5;

        if($search || $distance || ($category && $category != 'all')) {
            $foodQuery = null;

            if($search) $foodQuery = Food::where('name', 'like', '%'.$search.'%');
            if($distance) !$foodQuery ? $foodQuery = Food::whereHas('mitra', function($query) use ($distance, $latitude, $longitude) {
                $query->selectRaw("
                (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude)))) AS jarak")
                ->having('jarak', '<=', $distance);
            }) : $foodQuery = $foodQuery->whereHas('mitra', function ($query) use ($distance, $latitude, $longitude) {
                $query->selectRaw("
                (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude)))) AS jarak")
                ->having('jarak', '<=', $distance);
            });
            if($category && $category != 'all') !$foodQuery ? $foodQuery = Food::where('food_category_id', '=', $category) : $foodQuery = $foodQuery->where('food_category_id', '=', $category);

            $foodList = $foodQuery->get();
        }

        return view('userPage.foodList')
            ->with('categoryList', $categoryList)
            ->with('foodList', $foodList)
            ->with('search', $search ?? '')
            ->with('distance', $distance)
            ->with('category', $category ?? 'all');
    }

    public function foodMapAPI(Request $request) {
        $search = $request->input('search');
        $distance = $request->input('distance');
        $category = $request->input('category');

        $latitude = Cookie::get('latitude');
        $longitude = Cookie::get('longitude');

        $distance = $distance ?? 5;

        if($search || $distance || ($category && $category != 'all')) {
            $foodQuery = null;

            if($search) $foodQuery = Food::with('mitra')->where('name', 'like', '%'.$search.'%');
            if($distance) !$foodQuery ? $foodQuery = Food::with('mitra')->whereHas('mitra', function($query) use ($distance, $latitude, $longitude) {
                $query->selectRaw("
                (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude)))) AS jarak")
                ->having('jarak', '<=', $distance);
            }) : $foodQuery = $foodQuery->whereHas('mitra', function ($query) use ($distance, $latitude, $longitude) {
                $query->selectRaw("
                (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude)))) AS jarak")
                ->having('jarak', '<=', $distance);
            });
            if($category && $category != 'all') !$foodQuery ? $foodQuery = Food::with('mitra')->where('food_category_id', '=', $category) : $foodQuery = $foodQuery->where('food_category_id', '=', $category);

            $foodList = $foodQuery->get();
        }

        return $foodList;
    }

    public function foodDetail(Food $food) {
        $food->with('review');
        $wishlist = false;

        if(Auth::check()){
            $wishlist = Wishlist::where('user_id', '=', Auth::user()->id)->where('food_id', '=', $food->id)->first() ? true : false;
        }

        return view('userPage.foodDetail')
            ->with('food', $food)
            ->with('wishlist', $wishlist);
    }

    public function wishlistToggle(Food $food) {
        $wishlist = Wishlist::where('user_id', '=', Auth::user()->id)->where('food_id', '=', $food->id)->first();

        if ($wishlist) $wishlist->delete();
        else {
            $newWishlist = new Wishlist();
            $newWishlist->user_id = Auth::user()->id;
            $newWishlist->food_id = $food->id;
            $newWishlist->save();
        }

        return redirect()->route('foodDetail', $food->id);
    }

    public function foodDetailMtd(Request $request, Food $food) {
        $validateReq = $request->validate([
            'qty' => 'required|numeric',
        ]);

        Session::put('qty', $request->qty);
        Session::put('food_id', $food->id);

        return redirect()->route('checkoutPage');
    }

    public function foodReviewPage(Order $order) {
        return view('userPage.review')
            ->with('order', $order);
    }

    public function foodReviewMtd(Request $request) {
        $validateReq = $request->validate([
            'rating' => 'required|numeric',
            'order_id' => 'required|numeric',
        ]);

        $order = Order::where('id', '=', $request->order_id)->first();
        if($order->user_id != Auth::user()->id) return redirect()->route('home');

        $review = new Review();
        $review->comment = $request->review;
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->order_id = $order->id;
        $review->food_id = $order->food_id;
        $review->save();

        $food = $order->food;

        $food->rating = (($food->order_count * $food->rating) + $request->rating) / ($food->order_count + 1);
        $food->order_count += 1;
        $food->save();

        $order->status = 3;
        $order->save();

        $user = Auth::user();
        $user->coin = $user->coin + ($order->total_food_price * 0.05);
        $user->save();

        return redirect()->route('history');
    }
}
