<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return Brand::all();
    }

    public function show($id)
    {
        return Brand::find($id);
    }

    public function store(Request $request)
    {
        return Brand::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->update($request->all());
        return $brand;
    }

    public function destroy($id)
    {
        return Brand::destroy($id);
    }
}
