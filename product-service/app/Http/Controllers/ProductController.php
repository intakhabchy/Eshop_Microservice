<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all()->with(['brand', 'category', 'supplier']);
    }

    public function show($id)
    {
        return Product::find($id)->with(['brand', 'category']);
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'short_description' => $request->input('short_description'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'stock_quantity' => $request->input('stock_quantity'),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'remarks' => $request->input('remarks'),
        ]);

        $productDetail = $product->detail()->create([
            'description' => $request->description,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        // Load detail for response
        $product->load('detail');

        // Return JSON response
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
