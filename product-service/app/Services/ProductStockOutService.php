<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductStockOutRepository;
use Illuminate\Support\Facades\DB;

class ProductStockOutService
{
    private $productStockOutRepo;

    public function __construct(ProductStockOutRepository $productStockOutRepo)
    {
        $this->productStockOutRepo = $productStockOutRepo;
    }

    public function createStockOut($data)
    {
        $stockOut = $this->productStockOutRepo->createStockOut($data);

        Product::where('id', $data['product_id'])->update([
            'stock_quantity' => DB::raw('stock_quantity - '.$data['quantity'])
        ]);

        return response()->json($stockOut,201);
    }
}