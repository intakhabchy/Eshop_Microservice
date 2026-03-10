<?php

namespace App\Http\Controllers;

use App\Models\ProductStockIn;
use App\Services\ProductStockInService;
use Illuminate\Http\Request;

class ProductStockInController extends Controller
{
    private $productStockInService;

    public function __construct(ProductStockInService $productStockInService)
    {
        $this->productStockInService = $productStockInService;
    }
    
    public function store(Request $request)
    {
        $stockIn = $this->productStockInService->createStockIn($request->all());

        return response()->json($stockIn, 201);
    }
}
