<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'tracking_id',
        'shipping_address',
        'total_price',
        'vat',
        'payable_price',
        'delivery_status',
        'payment_status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
