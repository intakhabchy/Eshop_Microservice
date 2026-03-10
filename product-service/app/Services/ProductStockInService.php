<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductStockInRepository;
use Illuminate\Support\Facades\DB;

class ProductStockInService
{
    private $productStockInRepo;

    public function __construct(ProductStockInRepository $productStockInRepo)
    {
        $this->productStockInRepo = $productStockInRepo;
    }

    public function createStockIn($data)
    {
        $stockIn = $this->productStockInRepo->createStockIn($data);

        Product::where('id', $data['product_id'])->update([
            'stock_quantity' => DB::raw('stock_quantity + '.$data['quantity'])
        ]);

        return response()->json($stockIn,201);
    }
}