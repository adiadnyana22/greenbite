<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_code',
        'date',
        'qty',
        'total_food_price',
        'voucher_nominal',
        'coin_nominal',
        'grand_total',
        'status',
        'user_id',
        'food_id',
    ];

    public function food() {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
