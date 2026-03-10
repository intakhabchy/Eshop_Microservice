<?php
namespace App\Repositories;

use App\Models\ProductStockOut;

class ProductStockOutRepository
{
    public function createStockOut($data)
    {
        return ProductStockOut::create($data);
    }
}