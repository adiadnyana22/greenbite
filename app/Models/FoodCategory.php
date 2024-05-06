<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function food() {
        return $this->hasMany(Food::class, 'food_category_id', 'id');
    }
}
