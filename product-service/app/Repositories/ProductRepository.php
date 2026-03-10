<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function createProductWithDetail($data)
    {
        $product = Product::create([
            'product_name' => $data['product_name'],
            'short_description' => $data['short_description'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'stock_quantity' => $data['stock_quantity'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'remarks' => $data['remarks'],
        ]);

        $productDetail = $product->detail()->create([
            'description' => $data['description'],
            'color' => $data['color'],
            'size' => $data['size'],
        ]);

        return $product->load('detail');
    }
}