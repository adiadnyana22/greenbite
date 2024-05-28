<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminFoodController extends Controller
{
    public function foodListPage() {
        $foodList = Food::where('mitra_id', '=', Auth::user()->mitra->mitra_id)->get();

        return view('adminPage.food')->with('foodList', $foodList);
    }

    public function foodDetailPage(Food $food) {
        return view('adminPage.food-detail')->with('food', $food);
    }

    public function foodEditPage(Food $food) {
        $categoryList = FoodCategory::all();
        return view('adminPage.food-edit')->with('food', $food)->with('categoryList', $categoryList);
    }

    public function foodEditMethod(Food $food, Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'max_qty' => 'required|numeric',
            'day_to_expiration' => 'required|numeric',
            'start_pickup' => 'required',
            'end_pickup' => 'required',
            'normal_price' => 'required|numeric',
            'current_price' => 'required|numeric',
            'category' => 'required|numeric'
        ]);

        $food->name = $request->name;
        $food->stock = $request->stock;
        $food->min_qty = $request->min_qty;
        $food->max_qty = $request->max_qty;
        $food->day_to_expiration = $request->day_to_expiration;
        $food->start_pickup = $request->start_pickup;
        $food->end_pickup = $request->end_pickup;
        $food->normal_price = $request->normal_price;
        $food->current_price = $request->current_price;
        $food->food_category_id = $request->category;
        $food->save();

        return redirect()->route('adminFood');
    }

    public function foodAddPage() {
        $categoryList = FoodCategory::all();
        return view('adminPage.food-add')->with('categoryList', $categoryList);
    }

    public function foodAddMethod(Request $request) {
        $validateReq = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'max_qty' => 'required|numeric',
            'day_to_expiration' => 'required|numeric',
            'start_pickup' => 'required',
            'end_pickup' => 'required',
            'normal_price' => 'required|numeric',
            'current_price' => 'required|numeric',
            'category' => 'required|numeric'
        ]);

        $food = new Food();
        $food->name = $request->name;
        $food->stock = $request->stock;
        $food->min_qty = $request->min_qty;
        $food->max_qty = $request->max_qty;
        $food->day_to_expiration = $request->day_to_expiration;
        $food->start_pickup = $request->start_pickup;
        $food->end_pickup = $request->end_pickup;
        $food->normal_price = $request->normal_price;
        $food->current_price = $request->current_price;
        $food->food_category_id = $request->category;
        $food->mitra_id = Auth::user()->mitra->mitra_id;
        $food->rating = 0;
        $food->order_count = 0;
        $food->save();

        return redirect()->route('adminFood');
    }

    public function foodDeleteMethod(Food $food) {
        $food->delete();

        return redirect()->route('adminFood');
    }
}
