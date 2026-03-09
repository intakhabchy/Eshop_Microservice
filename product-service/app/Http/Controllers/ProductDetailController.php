<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index()
    {
        return ProductDetail::all();
    }

    public function show($id)
    {
        return ProductDetail::find($id);
    }

    public function store(Request $request)
    {
        return ProductDetail::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $product_detail = ProductDetail::find($id);
        $product_detail->update($request->all());
        return $product_detail;
    }

    public function destroy($id)
    {
        return ProductDetail::destroy($id);
    }
}
