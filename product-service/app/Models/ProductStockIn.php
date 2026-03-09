<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStockIn extends Model
{
    protected $fillable = ['product_id', 'quantity', 'purchase_price', 'supplier_id', 'stock_in_date'];
}
