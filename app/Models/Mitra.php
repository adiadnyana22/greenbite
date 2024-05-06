<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'logo',
        'status',
    ];

    public function mitraOrder() {
        return Order::whereIn('food_id', function($query) {
            $query->select('id')
                ->from('food')
                ->where('mitra_id', $this->id);
        })->orderBy('created_at', 'desc')->get();
    }

    public function mitraOrderOngoing() {
        return Order::whereIn('food_id', function($query) {
            $query->select('id')
                ->from('food')
                ->where('mitra_id', $this->id);
        })->where('status', '=', 1)->whereDate('date', '=', Carbon::today())->get();
    }

    public function food() {
        return $this->hasMany(Food::class, 'mitra_id', 'id');
    }

    public function user() {
        return $this->hasOne(UserMitra::class, 'mitra_id', 'id');
    }
}
