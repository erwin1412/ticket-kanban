<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'name',
        'phone_number',
        'weight',
        'courier',
        'service',
        'total_price',
        'shipping_cost',
        'total_amount',
        'address',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
