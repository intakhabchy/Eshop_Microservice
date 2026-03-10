<?php

namespace App\Http\Controllers;

use App\Services\ProductStockOutService;
use Illuminate\Http\Request;

class ProductStockOutController extends Controller
{
    private $productStockOutService;

    public function __construct(ProductStockOutService $productStockOutService)
    {
        $this->productStockOutService = $productStockOutService;
    }

    public function store(Request $request)
    {
        $stockOut = $this->productStockOutService->createStockOut($request->all());

        return response()->json($stockOut, 201);
    }
}
