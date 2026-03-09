<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStockOut extends Model
{
    protected $fillable = ['product_id', 'quantity', 'reference_type', 'reference_id'];
}
