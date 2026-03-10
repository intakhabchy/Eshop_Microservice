<?php
namespace App\Repositories;

use App\Models\ProductStockIn;

class ProductStockInRepository
{
    public function createStockIn($data)
    {
        return ProductStockIn::create($data);
    }
}