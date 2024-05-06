<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'min_qty',
        'max_qty',
        'day_to_expiration',
        'start_pickup',
        'end_pickup',
        'rating',
        'order_count',
        'normal_price',
        'current_price',
        'mitra_id',
        'food_category_id',
    ];

    public function wishlist() {
        return $this->hasMany(Wishlist::class, 'food_id', 'id');
    }

    public function mitra() {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id');
    }

    public function review() {
        return $this->hasMany(Review::class, 'food_id', 'id');
    }

    public function category() {
        return $this->belongsTo(FoodCategory::class, 'food_category_id', 'id');
    }

    public function order() {
        return $this->hasMany(Order::class, 'food_id', 'id');
    }
}
