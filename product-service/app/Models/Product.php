<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'short_description', 'price', 'discount', 'stock_quantity', 'category_id', 'brand_id', 'remarks'];

    public function detail()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
